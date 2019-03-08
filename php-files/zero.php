<?php
    include '_functions.php';

    $title = 'Zero Glycemic Index Foods';
    $descr = 'Which foods have zero glycemic index?';
    $keywords = 'zero glycemic index, zero glycemic foods';
    
    include '_header.php';
    
    printFilter('Zero Glycemic Index Foods', null);
    printTable('zero', null);
    
    include '_footer.php';
?>