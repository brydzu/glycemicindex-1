<?php
    include '_functions.php';
    
    //$tag = 'vegetables-and-fruits';
    $category = getCategoryId($tag);
    if (is_null($category)){
        header('Location: /');
        exit();
    }
    
    $title = 'Glycemic index table for category '.$category->name;
    $descr = 'How much glycemic index that '.$category->name.' category have?';
    $keywords = $category->name.' glycemic index';
    include '_header.php';
    
    printFilter('Category for ', ' - '.$category->name);
    printTable('category', $category->id);

    include '_footer.php'; 
?>
