<?php
    include '_functions.php';

    $title = 'High Glycemic Index Foods';
    $descr = 'Which foods have High glycemic index?';
    $keywords = 'high glycemic index, high glycemic foods';
    
    include '_header.php';
    
    printFilter('High Glycemic Index Foods', null);
    printTable('high', null);
    
    include '_footer.php';
?>