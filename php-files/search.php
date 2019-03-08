<?php
    include '_functions.php';
    
    //$tag = 'ppl';
    
    if ($tag == '' || strlen($tag) < 3) $tag = 'xxxxxxxx';
    
    $title = 'Search results of Glycemic index foods for '.$tag;
    $descr = 'Search results for keyword '.$tag;
    $keywords = 'glycemic index foods search result '.$tag;
    include '_header.php';
    
    printFilter('Search Results for', $tag);
    printTable('search', strtolower($tag));

    include '_footer.php'; 
?>
