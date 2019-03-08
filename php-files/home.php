<?php
    include '_functions.php';
    
    $title = 'Glycemic index table of foods. Check it out before you eat';
    $descr = 'The ultime glycemic index table for foods. You can search your foods, browse low, medium and high glycemic index foods. Browse the foods by their categories.  ';
    $keywords = 'glycemic index, food index, glycemic foods, high glycemic foods, low glycemic, zero glycemic foods, glycemic foods by letters, glycemic index by food category';
    include '_header.php';
?>    

	<br/>
	<h1>Welcome to GlycemicIndex.info</h1>

	<br/>
	<div class="row">
		<div class="col-12">
        	<div class="card mb-3">   
        		<div class="card-body">
                    <h4 class="card-title">Pay Attention!</h4>
                    <p class="card-text">
        				Approximately 425 million adults (20-79 years) were living with diabetes; by 2045 this will rise to 629 million (source:www.idf.org).
        			</p>        		
        		</div>
        	</div>		
		</div>
	</div>

	<div class="row">
		<div class="col-6">
        	<div class="card mb-3">   
        		<div class="card-body">
                    <h4 class="card-title">What is Glycemic Index?</h4>
                    <p class="card-text">
        				The glycemic index is a number associated with the carbohydrates in a particular type of food that indicates the effect of these carbohydrates on a person's blood glucose. A value of 100 represents the standard, an equivalent amount of pure glucose.
        				(source:wikipedia.org)
        			</p>
        		 </div>
            </div>
		</div>
		
		<div class="col-6">
        	<div class="card mb-3">   
        		<div class="card-body">
                    <h4 class="card-title">Glycemic Index Legend</h4>
                    <p class="card-text">
        				<span class="badge badge-pill bg-success text-light">Low</span> less than <b>55</b>
        			</p>

                    <p class="card-text">
        				<span class="badge badge-pill bg-info text-light">Medium</span> between <b>55 and 69</b>
        			</p>

                    <p class="card-text">
        				<span class="badge badge-pill bg-danger text-light">High</span> greater than <b>69</b>
        			</p>

        		 </div>
            </div>
		</div>		
		
	</div>
    
	<div class="row">
		<?= printCats(); ?>
		<?= printLetters(); ?>
	</div>	

	<div class="row">
		<?= printSummary ('zero', 'Zero Glycemic Foods', '/zero-glycemic-foods'); ?>
		<?= printSummary ('low', 'Low Glycemic Foods', '/low-glycemic-foods'); ?>
		<?= printSummary ('medium', 'Medium Glycemic Foods', '/medium-glycemic-foods'); ?>
		<?= printSummary ('high', 'High Glycemic Foods', '/high-glycemic-foods'); ?>
	</div>

<?php  
    include '_footer.php';

    function printSummary($type, $title, $link){
?>
		<div class="col m-2">
            <div class="card border-primary mb-3" style="max-width: 18rem;">
              <div class="card-header"><?= $title ?></div>
              <div class="card-body text-dark">
                <p class="card-text">

                <table class="table table-sm">
                  <tbody>
                	<?php 
                        $q = getFoods($type, null, 5);
                        while ($row = mysqli_fetch_array($q)) {
                    ?>
                    
                        <tr>
                          <td><a href="/food/<?= $row['food_slug'] ?>"><?= $row['food'] ?></a><br/></td>
                          <td><?= intval($row['food_gi']) ?></td>
                        </tr>        
                    
                    <?php 
                        }
                    ?>
                  </tbody>
            	</table>


				</p>
                <a href="<?= $link?>" class="btn btn-primary">See All</a>
              </div>
            </div>
		</div>
	  
        

<?php         
    }
    
    function printCats(){ ?>

		<div class="col">
        	<div class="card mb-3">   
        		<div class="card-body">
                    <h5 class="card-title">Browse by Category</h5>
                    <p class="card-text">
        
                        <?php 
                        $c = getCategories();
                        foreach ($c as $item){ ?>
                        	<a class="badge badge-light" href="/category/<?= $item->slug ?>"><?= $item->name ?></a>
                        <?php } ?>
        
        			</p>
        		 </div>
            </div>   
		</div>

<?php        
    }  
    

    function printLetters(){ ?>
    
		<div class="col">
        	<div class="card mb-3">   
        		<div class="card-body">
                    <h5 class="card-title">Browse by Letters</h5>
                    <p class="card-text">
        
                        <?php 
                        foreach (range('A', 'M') as $char) { ?>
                        	<a class="badge badge-secondary" href="/glycemic-foods-starts-with/<?= strtolower($char) ?>"><?= $char ?></a> 
                        <?php } ?>
                        <br/>
                        <?php 
                        foreach (range('N', 'Z') as $char) { ?>
                        	<a class="badge badge-secondary" href="/glycemic-foods-starts-with/<?= strtolower($char) ?>"><?= $char ?></a> 
                        <?php } ?>
        			</p>
        		 </div>
            </div>   
		</div>    

<?php  
    }
    
?>
