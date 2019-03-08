<?php
include '_functions.php';

    $title = 'Bookmark instructions for the website';
    $descr = 'Bookmark glycemicindex.info';
    $keywords = 'bookmark';

include '_header.php';
?>

<h1>Bookmark the 'www.glycemicindex.info'</h1>

<div class="card">
  <div class="card-body">
      <h5 class="card-title">What can I bookmark your web site?</h5>

		Just click the button below to learn how to bookmark web site to your bookmarks.

		<br/>
		<br/>
		<a id="bookmark-this" href="#" title="Bookmark This Page">Bookmark This Page</a>
		
		<br/>
		<br/>
		<h5>Thank you.</h5>		

  </div>
</div>

<br />
<br />
<br />



<style>


#bookmark-this {
  padding: 5px 10px;
  background-color: #f0ad4e;
  border: 1px solid #eea236;
  border-radius: 4px;
  font-size: 12px;
  color: #fff;
  text-decoration: none;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, .2);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
  -webkit-user-select:none;
  -moz-user-select:none;
  -ms-user-select:none;
  user-select:none;
}

#bookmark-this:hover {
  background-color: #ec971f;
  border: 1px solid #d58512;
  text-decoration: none;
}

#bookmark-this:active {
  background-color: #ec971f;
  border: 1px solid #d58512;
  -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
}

</style>


<?php    include '_footer.php';
?>

<script>

jQuery(function($) {
	  
	  $('#bookmark-this').click(function(e) {
	    var bookmarkURL = window.location.href;
	    var bookmarkTitle = document.title;

	    if ('addToHomescreen' in window && addToHomescreen.isCompatible) {
	      // Mobile browsers
	      addToHomescreen({ autostart: false, startDelay: 0 }).show(true);
	    } else if (window.sidebar && window.sidebar.addPanel) {
	      // Firefox <=22
	      window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
	    } else if ((window.sidebar && /Firefox/i.test(navigator.userAgent)) || (window.opera && window.print)) {
	      // Firefox 23+ and Opera <=14
	      $(this).attr({
	        href: bookmarkURL,
	        title: bookmarkTitle,
	        rel: 'sidebar'
	      }).off(e);
	      return true;
	    } else if (window.external && ('AddFavorite' in window.external)) {
	      // IE Favorites
	      window.external.AddFavorite(bookmarkURL, bookmarkTitle);
	    } else {
	      // Other browsers (mainly WebKit & Blink - Safari, Chrome, Opera 15+)
	      alert('Press ' + (/Mac/i.test(navigator.platform) ? 'Cmd' : 'Ctrl') + '+D to bookmark this page.');
	    }

	    return false;
	  });
	  
	});

</script>