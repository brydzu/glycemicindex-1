<?php
    include '_functions.php';

    $title = 'Medium Glycemic Index Foods';
    $descr = 'Which foods have medium glycemic index?';
    $keywords = 'medium glycemic index, medium glycemic foods';

    include '_header.php';
    
    printFilter('Medium Glycemic Index Foods', null);
    printTable('medium', null);
    
    include '_footer.php';
?>
