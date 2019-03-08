<?php
    include '_functions.php';
    
    header('Content-type: application/xml; charset=utf-8');
    $url_prefix = 'http://www.glycemicindex.info/';
    $max_date='2018-10-11T09:05:00+00:00';
    
    // $W3C_datetime_format_php = 'Y-m-d\Th:i:s'; // See http://www.w3.org/TR/NOTE-datetime
    // $posts[$i]['date_updated'] = date_decode($posts[$i]['date_updated'], $blog_timezone, $W3C_datetime_format_php) . $timezone_offset;
    
    
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    
 ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> 
<url>
  <loc><?= $url_prefix ?></loc>
  <lastmod><?php print $max_date ?></lastmod>
  <changefreq>weekly</changefreq>
</url>
<?= printStatic ('glycemic-index-foods') ?>
<?= printStatic ('high-glycemic-foods') ?>
<?= printStatic ('low-glycemic-foods') ?>
<?= printStatic ('medium-glycemic-foods') ?>
<?= printStatic ('zero-glycemic-foods') ?>
<?= printStatic ('glycemic-index') ?>
<?= printStatic ('advertise') ?>
<?= printStatic ('bookmark-us') ?>
<?= printStatic ('about') ?>
<?= printStatic ('contact') ?>
<?= printStatic ('terms-and-use') ?>
<?= printStatic ('privacy-policy') ?>
<?= printStatic ('similar-glycemic_index') ?>

<?php 
    foreach (range('A', 'Z') as $char) {
        printStatic ('glycemic-foods-starts-with/'.strtolower($char));
	}

$array = getCategories();
foreach ($array as $item) { 
?><url>
  <loc>http://www.glycemicindex.info/category/<?php print htmlspecialchars($item->slug) ?></loc>
  <lastmod><?php print $max_date ?></lastmod>
</url>
<?php }


$q = getFoods('all', null, null);
while ($row = mysqli_fetch_array($q)) {

?><url>
  <loc>http://www.glycemicindex.info/food/<?php print htmlspecialchars($row['food_slug']) ?></loc>
  <lastmod><?php print $max_date ?></lastmod>
</url>
<?php } 



?></urlset><?php 

function printStatic($url){
    global $max_date;
    
?>
<url>
  <loc>http://www.glycemicindex.info/<?= $url ?></loc>
  <lastmod><?php print $max_date ?></lastmod>
</url>
<?php 
}


?>