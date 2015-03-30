<?php
require $_SERVER['DOCUMENT_ROOT'] . '/php/config.php';

function reload()
{	$header_location = 'Location: ' . preg_replace('/\.php|index\.php/', '', $_SERVER['PHP_SELF']);
	if (!empty($_SERVER['QUERY_STRING']))
	{	$header_location .= '?' . $_SERVER['QUERY_STRING'];
	}
	header($header_location);
}

session_start();

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') === 0)
{	$_SESSION['postdata'] = $_POST;
	reload();
	exit;
}

if (isset($_SESSION['postdata']))
{	$_POST = $_SESSION['postdata'];
	unset($_SESSION['postdata']);
}

if (isset($_SESSION['error']))
{	$error = $_SESSION['error'];

	unset($_SESSION['error']);
}

$db = new PDO("$DATABASE_TYPE:dbname=$DATABASE_NAME;host=$DATABASE_HOST", $USER_NAME, $USER_PASSWORD);
?>

<!DOCTYPE html>
<html lang='en'>
<head>

	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='The Robbinsville High School store.'>

	<title>Rville Spirit</title>

	<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
	<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='css/style.css'>

	<link rel='shortcut icon' sizes='16x16 24x24 32x32 48x48 64x64' href='//rvillespirit.com/favicon.ico'>
	<link rel='apple-touch-icon' sizes='57x57' href='//rvillespirit.com/img/icon/apple-57.png'>
	<link rel='apple-touch-icon-precomposed' sizes='57x57' href='//rvillespirit.com/img/icon/apple-57.png'>
	<link rel='apple-touch-icon' sizes='72x72' href='//rvillespirit.com/img/icon/apple-72.png'>
	<link rel='apple-touch-icon' sizes='114x114' href='//rvillespirit.com/img/icon/apple-114.png'>
	<link rel='apple-touch-icon' sizes='120x120' href='//rvillespirit.com/img/icon/apple-120.png'>
	<link rel='apple-touch-icon' sizes='144x144' href='//rvillespirit.com/img/icon/apple-144.png'>
	<link rel='apple-touch-icon' sizes='152x152' href='//rvillespirit.com/img/icon/apple-152.png'>
	<meta name='apple-mobile-web-app-capable' content='yes'>
	<meta name='apple-mobile-web-app-status-bar-style' content='black'>
	<meta name='application-name' content='Rville Spirit'>
	<meta name='msapplication-TileImage' content='//rvillespirit.com/img/icon/apple-144.png'>
	<meta name='msapplication-TileColor' content='#222'>

	<!--[if lt IE 9]>
		<script src='//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
		<script src='//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
	<![endif]-->

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-39410002-9', 'auto');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');
	</script>

</head>
<body>

	<div class='navbar navbar-default' role='navigation'>
		<div class='container-fluid'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-collapse'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<div class='navbar-header'>
				<a class='navbar-brand' href='/'>Rville Spirit</a>
			</div>
			<div class='collapse navbar-collapse'>
				<form class='navbar-form navbar-right' action='https://www.paypal.com/cgi-bin/webscr' method='post' role='form'>
					<input type='hidden' name='cmd' value='_s-xclick'>
					<input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----'>
					<button type='submit' class='btn btn-default'>View cart</button>
				</form>
			</div>
		</div>
	</div>

	<a id='page'></a>
	<div class='container'>
