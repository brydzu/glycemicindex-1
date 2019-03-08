<?php
    include '_functions.php';
    
    //$tag = 'steak'; // TODO sil
    $food = getFoodById($tag);
    if (is_null($food)){
        header('Location: /');
        exit();
    }
    
    $foodInfo = getFoodInfo($food);
    
    $title = 'What is the glycemic index of '.$food->food;
    $descr = 'Glycemic index of '.$food->food. '.  Is it high, low or medium? What is index rank of '.$food->food.'? Do we need to avoid eating '.$food->food.' or not?';
    $keywords = $food->food.' glycemic index, '.$food->food.' gi, glycemic index '.$food->food.', '.$food->category.' glycemic index';
    
    include '_header.php';
?>

    <div class="container-fluid">
		<br />
    	<div class="row">
    		<div class="col-5 text-center">
    			<img src="<?= getFoodPhoto($food->foodSlug) ?>" alt="<?= $food->food ?>" class="img-fluid" width="400" />
    			<p><?= $food->food ?></p>
    		</div>
    		<div class="col-4">
    			<h1>
    				Glycemic Index for <b><?= $food->food ?></b>
    			</h1>
    			
    			<p>
    				<a href="/category/<?= $food->categorySlug ?>" class="txt-success"><?= $food->category ?></a>
    			</p>


    			<h1>
    				<b><?= $food->foodGi ?></b>  
    			</h1>
    			
    			<h6><span class="badge badge-pill <?= getIndexBadge($food->foodGi) ?>">glycemic Level is <?= getIndexMsg($food->foodGi) ?></span></h6>
    			

    			<div>
    				<br />
    				<br />
    				<b>General Advice:</b> 
    				<br><?= getDoctorAdvice($food->foodRank) ?>
    			</div>
    			

    		</div>
    		<div class="col-2">

                
    		</div>
    	</div>

    	<div class="row">
    		<div class="col-md-3">
    		</div>
    		<div class="col-md-6">
    			<br />
    			<div class="btn-group btn-group-md" role="group">
    				<a href="/<?= strtolower(getIndexMsg($food->foodGi)) ?>-glycemic-foods" class="btn btn-warning">Other <?= getIndexMsg($food->foodGi) ?> Glycemic Foods</a>
            		&nbsp;&nbsp;<a href="/similar-glycemic_index/<?= $food->foodGi ?>" class="btn btn-success">Similar Glycemic Foods</a>
    			</div>
    		</div>
    		<div class="col-md-3">
    		</div>
    	</div>
    	
    </div>


	


<?php
    include '_footer.php'; 
?>
