<html>
<head>
	<title>Epic Title Generator</title>
	
	<meta name="viewport" content="width=device-width">


	<!-- Vendor -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/seedrandom/2.4.0/seedrandom.min.js"></script>
	<script src="//code.jquery.com/jquery-2.1.4.js"></script>
	
	<link href='http://fonts.googleapis.com/css?family=MedievalSharp' rel='stylesheet' type='text/css'>
	
	<!-- Bootstrap: -->
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


	<!-- Source -->
	<script type="text/javascript" src="js/word-bank.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="shortcut icon" href="media/favicon-static.ico" type="image/x-icon">
	<link rel="icon" href="media/favicon-animated.ico" type="image/x-icon">




	<!-- Dynamic -->
	<script>var currentTitleIsNameBased = false;</script>

	<?php

		$rootUrl = 'http://EpicTitleGenerator.com';

		if( isset($_GET['seed_name']) && $_GET['seed_name'] ){
			
			$og_title = $_GET['seed_name'].'\'s title on the Epic Title Generator';
			$og_description = "What's YOUR epic title?";
			$og_url = $rootUrl . '/?epic_title=' . $_GET['epic_title'] . '&seed_name=' . $_GET['seed_name'];
			$og_image = $rootUrl . '/' . require('title-image-url.php');

			echo '<script>currentTitleIsNameBased = true;</script>';

		} elseif (isset($_GET['epic_title']) && $_GET['epic_title']) {
			
			$og_title = 'Epic Title Generator';
			$og_description = "Where epic titles are born!";
			$og_url = $rootUrl . '/?epic_title=' . $_GET['epic_title'];
			$og_image = $rootUrl . '/' . require('title-image-url.php');
		
		} else {

			$og_title = 'Epic Title Generator';
			$og_description = "Where epic titles are born!";
			$og_url = $rootUrl;
			$og_image = $rootUrl . '/media/banner.png';

		}

	?>


	<!-- Meta -->
		<!-- Begin Facebook tags -->
	<meta property="og:title" content="<?= $og_title ?>" />
	<meta property="og:url" content="<?= $og_url ?>" />
	<meta property="og:description" content="<?= $og_description ?>" />
	<meta property="og:image" content="<?= $og_image ?>" />
	<!--<meta property="fb:page_id" content="Your facebook page ID" />-->
	<meta property="og:type" content="website" />
		<!-- End Facebook tags -->

		<!-- Begin Twitter tags -->
	<!--
	<meta name="twitter:title" content="Epic Title Generator" />
	<meta name="twitter:url" content="http://EpicTitleGenerator.com/?epic_title=<?= $_GET['epic_title'] ?>" />
	<meta name="twitter:card" content="This is where you make your crazy epic titles!" />
	<meta name="twitter:image" content="URL to image for thumbnail (square 350x350px)" />
	-->
		<!-- End Twitter tags -->
</head>
<body>
	<h1 id="page-title" class="text-center" style="text-transform:none; opacity:.5;"><b style="font-size:1.75em;">
		<span>Epic Title Generator</span>
	</b></h1>
	<div id="output">
		<div id="epic-title">
			<b>
				<span id="position-article"><?=$_GET['epic_title']?></span>
				<span id="position-adjective"></span><!-- maybe -->
				<span id="position-noun"></span>
				<span id="position-domain-preposition"></span>
				<span id="domain-adjective"></span><!-- maybe -->
				<span id="domain-noun"></span>
				<span id="domain-concept-preposition"></span><!-- if concept-noun -->
				<span id="concept-noun"></span><!-- maybe -->
			</b>
			<img src="media/banner.png" />
		</div>
	</div>
	<div id="controls">
		<div id="seed-name" class="form-inline">
			<label>Your Name: <input id="seed" type="text" value="<?= $_GET['seed_name'] ?>" class="form-control"></label>
			<button onclick="seededRandom()" type="button" class="btn btn-default btn-md">
				Convert <!-- my  -->Name <!-- into -->to <!-- an  -->Epic Title
			</button>
		</div>
		<button  id="randomize-button" onclick="randomize()" type="button" class="btn btn-default btn-md">
			<!-- Generate a  -->Random Epic Title
		</button>
	</div>
	<div id="sharing">
		<button onclick="openEpicFbSharer()" type="button" class="btn btn-default btn-md"><b>
			Share <!-- your -->this Epic Title on Facebook! &raquo;
		</b></button>
	</div>
</body>
</html>