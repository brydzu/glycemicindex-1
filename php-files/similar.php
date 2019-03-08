<?php
    include '_functions.php';
    
    //$tag = '52';
    $nearId = $tag;
    
    $title = 'Similar glycemic index foods like'.$nearId;
    $descr = 'Which foods have similar gylcemic index about '.$nearId.'?';
    $keywords = 'glycemic index about'.$nearId;
    include '_header.php';
    
    printFilter('Similar Foods Near', $nearId. ' GI value');
    printTable('similar', $nearId);

    include '_footer.php'; 
?>
