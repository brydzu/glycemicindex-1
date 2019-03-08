<?php 
    include '_functions.php';

    $title = 'Low Glycemic Index Foods';
    $descr = 'Which foods have low glycemic index?';
	$keywords = 'low glycemic index, glycemic safe, low glycemic foods';

    include '_header.php';

    printFilter('Low Glycemic Index Foods', null); 
    printTable('low', null); 

    include '_footer.php';
?>