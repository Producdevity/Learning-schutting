<body>

<div class="wrapper">
<div class="subnav">
	<a href="#">nieuwsbrief</a>
	<a href="#">mobiel</a>
	<a href="#">contact</a>
	<a href="#">meld een fout</a>
	<a href="#">frequenties</a>
	<a href="#">help</a>
	<a href="#">rss</a>
</div>
<nav class="mainNav">
	<div class="menu_item"><a href="http://radio1.nl/" target="_blank">radio1.nl</a></div>
	<a class='menu_item' href="?page=top100">tour top 100</a>

	<input type="search" class="search" name="keywords"  placeholder="zoek binnen Radio1"/>
	<button type="submit" name="searchSubmit" class="searchSubmit"/><img src="images/magnify.png"/></button>
</nav>

<h1 id="logo">
	<a href="index.php">Radio 1 Tour Top 100</a>
</h1>

<div id="tourtop100_text">
	<img src="images/tourtop100.png" alt="" />
</div>

<a href="http://www.radio1.nl/popup/luisterlive" target="_blank"><div class="luisterLive_button"></div></a>
<div class="clear"></div>
<div class="calender">
	<ul>
		<li class="month">Juli</li>
		
		<?php 
			require("views/pagination.php");
		?>
		
	</ul>
</div>

<div class="content">



