<?php
    include '_functions.php';
    
    if ($tag == '') $tag = 'a';
    
    $title = 'Glycemic Index Foods Starts with '.$tag;
    $descr = 'Glycemic Index table for the foods starts with '.$tag;
    $keywords = 'glycemic index foods '.$tag.'-letter';
    
    include '_header.php';
    
    printFilter('Foods Name Starts with', strtoupper($tag));
    printTable('letter', strtolower($tag));

    include '_footer.php'; 
?>
