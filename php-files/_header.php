<?php
$commonKeys = ', glycemic index, glycemic, glucose, diet, diabetes, insulin, insulin resistance, blood sugar, health, healthcare, medical';
$canonical = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";

?><!doctype html>
<html lang="en">
	<head>
		<?php if ( ! isset($_SESSION['dontcount']) and strpos($_SERVER['SERVER_NAME'], '127.0.0.1') === false) {?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-613306-5"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-613306-5');
        </script>
        <?php } ?>

      	<title><?= $title ?> - GlycemicIndex.Info</title>
    	<meta name="title" content="<?= $title ?> - GlycemicIndex.Info">
    	<meta name="Description" content="<?= $descr ?>">
    	<meta name="Keywords" content="<?= $keywords.$commonKeys ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="canonical" href="<?=$canonical;?>" />

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
		<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
        <script async custom-element="amp-auto-ads"
                src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
        </script>
		<style>
		  .bg1 {
		      background-color: rgba(0, 60, 68, 1)
		  }
		  .txt1 {
		      color: white;
		  }
		</style>
	</head>
	<body>
        <div class="container-fluid bg1">
          <div class="row">
            <div class="col-1"></div>

            <div class="col">
            	<a href="/"><img src="/photo/glycemic-index-logo.png" class="img-fluid" width="514" height="60" /></a>
            </div>

			<div class="float-right">
    			<nav class="navbar navbar-expand-lg navbar-dark">
                  <a class="navbar-brand" href="#"></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
						
					  <a class="nav-item nav-link btn" href="/high-glycemic-foods">High</a>
                      <a class="nav-item nav-link btn" href="/medium-glycemic-foods">Medium</a>
                      <a class="nav-item nav-link btn" href="/low-glycemic-foods">Low</a>
                      <a class="nav-item nav-link btn" href="/zero-glycemic-foods">Zero</a>
                    </div>
                  </div>
                </nav> 				
            </div>
            
			<div class="col-1"></div>    
		</div>

    	</div>
    	
        <div class="container-fluid bg-secondary">
            <div class="row">
				<div class="col-1"></div>
				            
                <div class="col text-right">		
                    <form class="form-inline" action="/search" method="post">
                      <div class="form-group mx-sm-3 m-2">
                        <label for="q" class="sr-only">Search Foods</label>
                        <input type="text" size="40" class="form-control" name="q" placeholder="apple, bread, etc.">
                      </div>
                      <button type="submit" class="btn btn btn-light mt-2 mb-2">Search Foods</button>
                    </form>	   
                </div>

                <div class="col-4">
                </div>		

            </div>
        </div>


		<div class="container">
			<div class="row">
				<div class="col">
