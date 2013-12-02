<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Accessibility Options</title>
	<meta name="description" content="Select the website layout">
	<link rel="stylesheet" href="access.css">
</head>

<?php

	// General titles
	$wpacc_titles =
	"Standard Version,
	Accessible Version (Black on White),
	Accessible Version (Black on White - No Images),
	Accessible Version (White on Black),
	Accessible Version (White on Black - No Images)
	";

	$arr_titles = explode (",", $wpacc_titles);
	$count = 0;

?>

<body class="wpacc-layout-select">
	
	<div class="accessibility-container">

		<h1 class="accessibility-title">Accessibility Options</h1>

		<div class="accessibility-options">

			<?php
				echo "<ul class='wpacc-container'>";
				for ($x=0; $x<=4; $x++) {

					$count = $count +1;

					echo "<li class='wpacc-item item-". $count ."'><a href='../../../../index.php?wpacc=". $count ."'>" . $arr_titles[$x] . "</a></li>";
				}
				echo "</ul>";
			?>

		</div>

	</div>

</body>
</html>
