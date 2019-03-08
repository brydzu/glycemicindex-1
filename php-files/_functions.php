<?php 
session_start();


if ($_SERVER['HTTP_HOST'] != 'www.glycemicindex.info'){
    header("Location: http://www.glycemicindex.info".$_SERVER['REQUEST_URI']);
}

if ($_SERVER['HTTPS'] == "on") {
    header("HTTP/1.1 301 Moved Permanently");
    $url = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
}


// TODO: tom sql leri escape yap.
// select @rownum:=@rownum+1 ‘rank’, p.* from  Glycemic p, (SELECT @rownum:=0) r order by gi;



class FoodInfo{
    public $allRank;
    public $allCount;
    
    public $maxGi;
    
    public $catRank;
    public $catCount;
    
    public $groupRank;
    public $groupCount;
}

class Category {
    public $id;
    public $name;
    public $slug;
}

class Food {
    public $id;
    public $food;
    public $foodSlug;
    public $foodGi;
    public $foodRank;
    
    public $catId;
    public $category;
    public $categorySlug;
}



function connect(){
    $servername = "MYSQL_SERVER";
    $username = "MYSQL_USER";
    $password = "MYSQL_PASS";
    $db = "MYSQL_DB";
    $conn = @mysqli_connect($servername, $username, $password, $db);
    
    if (!$conn) {
        echo "Error: " . mysqli_connect_error();
        exit();
    }
    
    return $conn;
}


function disconnect($conn){
    mysqli_close ($conn);
}


function getIndexClass($no){
    if ($no == 0){
        $css = "secondary";
    } else if ($no < 55){
        $css = "success";
    } else if ($no < 70){
        $css = "warning";
    } else {
        $css = "danger";
    }
    
    return 'text-'.$css;
}

function getIndexBadge($no){
    if ($no == 0){
        $css = "secondary";
    } else if ($no < 55){
        $css = "success";
    } else if ($no < 70){
        $css = "warning";
    } else {
        $css = "danger";
    }
    
    return 'badge-'.$css;
}

function getIndexMsg($no){
    if ($no == 0){
        $css = "Zero";
    } else if ($no < 55){
        $css = "Low";
    } else if ($no < 70){
        $css = "Medium";
    } else {
        $css = "High";
    }
    
    return $css;
}

function getFoods($filter, $id, $limit){
        
        switch ($filter){
            
            case "search":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and lower(fg.food) like \'%'.$id.'%\' ';
                break;
                
            case "letter":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and lower(fg.food) like \''.$id.'%\' ';
                break;
                
            case "similar":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and fg.food_gi >= '. ($id*0.9). ' and fg.food_gi <= '.($id*1.10). ' order by fg.food_gi';
                break;
                
            case "high":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and fg.food_gi>69 order by fg.food_gi';
                break;
                
            case "low":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and fg.food_gi<55 and fg.food_gi>0 order by fg.food_gi';
                break;
                
            case "medium":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and fg.food_gi>=55 and fg.food_gi<=69 order by fg.food_gi';
                break;
                
            case "zero":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and fg.food_gi=0 order by fg.food_gi';
                break;
                
            case "category":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and fg.fc_id='.$id;
                break;

            case "all":
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id)';
                break;

            default:
                $sql = 'select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) and 1=2';
                break;

        }
        
        $limitN = ($limit > 0 ) ? ' LIMIT '.$limit : '';
        $sql .=  $limitN;
        
        $conn = connect();
        $query 	= mysqli_query($conn, $sql);
        disconnect($conn);
    
        return $query;
}

function printTable($filter, $id){ 
?>
        <table id="glyTable" class="table">
        <thead>
        <tr>
        <th scope="col">Food</th>
        <th scope="col">Category</th>
        <th scope="col">Glycemic Index</th>
        <th scope="col">Rank</th>
        </tr>
        </thead>
        <tbody>
        
        <?php
            $q = getFoods($filter, $id, null);
            while ($row = mysqli_fetch_array($q)) {
        ?>
            
                <tr>
                  <td class="line selectable"><a href="/food/<?= $row['food_slug'] ?>"><?= $row['food'] ?></a></td>
                  <td class="line selectable"><a href="/category/<?= $row['category_slug'] ?>"><?= $row['category'] ?></a></td>
                  <td class="line"><?= is_numeric($row['food_gi']) ? intval($row['food_gi']) : $row['food_gi'] ?></td>
                  <td class="line <?= getIndexClass($row['food_gi']) ?>"><?= getIndexMsg($row['food_gi']) ?></td>
                </tr>
        <?php 
            } ?>
          </tbody>
        </table>
<?php  
}

function getCategoryId($tag){
    $category = null;
    
    $conn = connect();
    $query = "SELECT * FROM FoodCategory WHERE category_slug='".$tag."'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        
        $category = new Category();
        $category->id = $row['fc_id'];
        $category->name = $row['category'];
        $category->slug = $row['category_slug'];
    }

    disconnect($conn);
    return $category;
}

function getFoodById($tag){
    $food = null;
    
    $conn = connect();
    $query = "select fg.*, fc.category, fc.category_slug from FoodGlycemic fg join FoodCategory fc on (fg.fc_id = fc.fc_id) WHERE fg.food_slug='".$tag."'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        
        $food = new Food();
        $food->id = $row['fg_id'];
        $food->food = $row['food'];
        $food->foodSlug = $row['food_slug'];
        $food->foodGi = intval($row['food_gi']);
        $food->foodRank = $row['food_rank'];
        
        $food->catId = $row['fc_id'];
        $food->category = $row['category'];
        $food->categorySlug = $row['category_slug'];
        
    }
    
    disconnect($conn);
    return $food;
}

function getCategories(){
    $category = null;
    
    $conn = connect();
    $query = "SELECT * FROM FoodCategory";
    
    if ($result = mysqli_query($conn, $query)) {
        $art_array = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            $category = new Category();
            $category->id = $row['fc_id'];
            $category->name = $row['category'];
            $category->slug = $row['category_slug'];
            
            $art_array[] = $category;
        }
    }
    
    disconnect($conn);
    return $art_array;
}


function getFoodInfo($food){
    $foodInfo = null;
        
    $conn = connect();
    
    $query = sprintf("
        select 
        	(select count(*) from FoodGlycemic where food_gi > %s) as allRank,
        	(select count(*) from FoodGlycemic) as allCount,
        	(select max(food_gi) from FoodGlycemic) as maxGi,
        	(select count(*) from FoodGlycemic where food_gi > %s and fc_id=%s)  as catRank,
        	(select count(*) from FoodGlycemic where fc_id = %s) as catCount,
        	(select count(*) from FoodGlycemic where food_rank = %s and food_gi > %s) as groupRank,
        	(select count(*) from FoodGlycemic where food_rank = %s) as groupCount
        ",
        mysqli_real_escape_string($conn, $food->foodGi),
        mysqli_real_escape_string($conn, $food->foodGi),
        mysqli_real_escape_string($conn, $food->catId),
        mysqli_real_escape_string($conn, $food->catId),
        mysqli_real_escape_string($conn, $food->foodRank),
        mysqli_real_escape_string($conn, $food->foodGi),
        mysqli_real_escape_string($conn, $food->foodRank)
        );
    
    $result = mysqli_query($conn, $query);
    
    //echo $query; exit;
    
    if (mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        
        $foodInfo = new FoodInfo();
        $foodInfo->allRank = $row['allRank'];
        $foodInfo->allCount = $row['allCount'];
        $foodInfo->maxGi = $row['maxGi'];
        $foodInfo->catRank = $row['catRank'];
        $foodInfo->catCount = $row['catCount'];
        $foodInfo->groupRank = $row['groupRank'];
        $foodInfo->groupCount = $row['groupCount'];
        
    }
    
    disconnect($conn);
    return $foodInfo;
    
}

function printFilter($item, $name){ ?>
                <br />
				 <?php if ($item <> 'all') { ?>
				 <div class="row"> 
				 	<div class="col">
                        <div class="p-2" role="alert">
                          <h1><span class="badge badge-warning">Displaying <?= $item?> <?= $name ?></span></h1>
                        </div>
				 	</div>
				 	<div class="col text-right">
				 		<div class="row">
                            <div class="dropdown p-2">
                              <button class="btn btn-md btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter by Rank
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/zero-glycemic-foods">Zero Glycemic Foods</a>
                                <a class="dropdown-item" href="/low-glycemic-foods">Low Glycemic Foods</a>
                                <a class="dropdown-item" href="/medium-glycemic-foods">Medium Glycemic Foods</a>
                                <a class="dropdown-item" href="/high-glycemic-foods">High Glycemic Foods</a>
                              </div>
                            </div>				 	
				 		
                            <div class="dropdown p-2">
                              <button class="btn btn-md btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter by Category
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        						<?php 
                                    $c = getCategories();
                                    foreach ($c as $item){ ?>
                                    
                                    <a class="dropdown-item" href="/category/<?= $item->slug ?>"><?= $item->name ?></a>
                                <?php } ?>                                
                                
                              </div>
                            </div>
                            
                            <div class="dropdown p-2">
                              <button class="btn btn-md btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter by Letter
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <?php 
                                foreach (range('A', 'Z') as $char) { ?>
								<a class="dropdown-item" href="/glycemic-foods-starts-with/<?= strtolower($char) ?>"><?= $char ?></a> 
                              <?php } ?>                                
                                
                              </div>
                            </div>	                            
                             		
				 		</div>
					</div>
				 </div>
				 
		 <?php } ?>
  
<?php                 
}

function getFoodPhoto($slug){
    if (file_exists('photo/'.$slug.'.png')){
        return '/photo/'.$slug.'.png';
    } else {
        return '/photo/noPhoto.jpg';
    }
}


function getIsAdminMessage(){
    return isset($_SESSION['dontcount']) ? '<a href=\'/logout/\'>(out)</a>' : '';
}


function getDoctorAdvice($level){
    $message = "";
    
    switch ($level){
        case 0:
            $message = "Zero glycemic index foods need less insuline to digest. Ask your doctor for detailed information.";
            break;
        
        case 1:
            $message = "Low glycemic index foods need less insuline to digest. Ask your doctor for detailed information.";
            break;

        case 2:
            $message = "Medium glycemic index foods need more insuline to digest. Eating these kind of foods should be <b>monitored</b>. Ask your doctor for detailed information.";
            break;
    
        case 3:
            $message = "High glycemic index foods need high insuline to digest. Eating these kind of foods should be <b>avoided</b>. Ask your doctor for detailed information.";
            break;

        case 3:
            $message = "N/A";
            break;
    }
    
    return $message;
    
}


function printAtoZ(){ ?>
     <div>
    <?php foreach (range('A', 'Z') as $char) { ?>
     	<a class="badge badge-warning" href="/glycemic-foods-starts-with/<?= strtolower($char) ?>"><?= $char ?></a> 
<?php } ?>
	</div>

<?php  
    }
?>