<?php
header('Content-Type: text/html; charset=UTF-8');
//error_reporting(-1);
require_once('../config.php');
require_once CLASS_FOLDER. '/autoload.php';

Autoload::init();

Language::init();

//echo Language::get()->getId();
//
$framework = new VublaFramework();
$framework->start();

/*
echo $_SESSION['iso'];
echo Language::get()->getLocale();
//VPDO::reset();
echo  LC_ALL;
echo $_SESSION['uid'];

/*
/*
ini_set('display_errors', 'stdout');*/



/*
$meta = VPDO::getVdo(DB_METADATA, DB_USER, DB_PASS);
$sql = "Select id from webshops where hostname like " . $meta->quote('%'.$host.'%'). " limit 1";
$wid = $meta->fetchOne($sql);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>Vubla</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript"></script>

<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="ie-style.css" />
<![endif]-->
<!--[if !IE]><!-->
        <link rel="stylesheet" type="text/css" href="nonie-style.css" />
 <!--<![endif]-->

<style type="text/css">
body
{
	background-color: #ffffff;
	behavior: url("csshover3.htc"); 
	font-family: Helvetica;
	font-size: 12px;
	text-align: left;
	padding: 0px;
	margin-top: 0px;
}
div.topbar
{
	margin-top: 0px;
	background-image:url('topbar.jpg');
	background-repeat:no-repeat;
	width: 851px;
	height: 5px;
	margin-left: auto;
	margin-right: auto;
	overflow: visible;
}
div.bloggen
{
	float: left;
	position:relative;
	top: 20px;
	left: 40px;
	background-image:url('bloggen.jpg');
	background-repeat:no-repeat;
	width: 181px;
	height: 40px;
}
div.twitter
{
	float: right;
	position:relative;
	top: 20px;
	left: -40px;
	background-image:url('twitter.jpg');
	background-repeat:no-repeat;
	width: 149px;
	height: 40px;
}
div.main
{
	position: relative;
	top: -49px;
	
	width: 447px;
	margin-left: auto;
	margin-right: auto;
	overflow: visible;
	font-family: 'Helvetica';
	font-size: 26px;
	line-height: 26px;
	text-align: left;
}
div.logo
{
	background-image:url('logo.jpg');
	background-repeat:no-repeat;
	width: 92px;
	height: 28px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 120px;
	margin-bottom: 20px;
}
div.five
{
	position: absolute;
	font-weight:bold;
	font-size:140px;
	color: #dddddd;
	left:-80px;
	top: 360px;	
}
a
{
	color: #3984ff;
}
a:hover
{
	color: #184081;
}
#box2
{
	
	-webkit-appearance: none;
	-webkit-rtl-ordering: logical;
	-webkit-user-select: text;
	background-attachment: scroll;
	background-clip: border-box;
	background-color: rgba(0, 0, 0, 0);
	background-image: url('simplebox.jpg');
	background-repeat:no-repeat;
	background-origin: padding-box;
	border-bottom-style: none;
	border-bottom-width: 0px;
	border-left-style: none;
	border-left-width: 0px;
	border-right-style: none;
	border-right-width: 0px;
	border-top-style: none;
	border-top-width: 0px;
	/*color: black; 
	color: #323232;
	cursor: auto;
	display: block;
	float: left;
	font-family: 'Helvetica';
	font-size: 16px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	height: 60px;
	letter-spacing: normal;
	line-height: normal;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	outline-color: black;
	outline-style: none;
	outline-width: 0px;
	padding-bottom: 0px;
	padding-left: 15px;
	padding-right: 15px;
	
	text-align: -webkit-auto;
	text-indent: 0px;
	text-shadow: none;
	text-transform: none;
	vertical-align: baseline;
	width: 305px;
	word-spacing: 0px;
}
#box3
{
	
	-webkit-appearance: none;
	-webkit-rtl-ordering: logical;
	-webkit-user-select: text;
	background-attachment: scroll;
	background-clip: border-box;
	background-color: rgba(0, 0, 0, 0);
	background-image: url('boxarea.jpg');
	background-repeat:no-repeat;
	background-origin: padding-box;
	border-bottom-style: none;
	border-bottom-width: 0px;
	border-left-style: none;
	border-left-width: 0px;
	border-right-style: none;
	border-right-width: 0px;
	border-top-style: none;
	border-top-width: 0px;
	/*color: black; 
	
	color: #323232;
	
	cursor: auto;
	display: block;
	float: left;
	font-family: 'Helvetica';
	font-size: 16px;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	height: 60px;
	letter-spacing: normal;
	line-height: normal;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	outline-color: black;
	outline-style: none;
	outline-width: 0px;
	padding-bottom: 0px;
	padding-left: 15px;
	padding-right: 15px;
	
	text-align: -webkit-auto;
	text-indent: 0px;
	text-shadow: none;
	text-transform: none;
	vertical-align: baseline;
	width: 305px;
	word-spacing: 0px;
}
div.boxframe
{
	margin-left: auto;
	margin-right: auto;
	width: 500px;
}
#submit 
{
	background-image:url('loginbutton.jpg');
	-webkit-appearance: none;
	-webkit-box-align: center;
	-webkit-box-sizing: border-box;
	-webkit-rtl-ordering: logical;
	-webkit-user-select: text;
	background-attachment: scroll;
	background-clip: border-box;
	background-color: #3984ff;
	background-origin: padding-box;
	border-bottom-color: white;
	border-bottom-style: none;
	border-bottom-width: 0px;
	border-left-color: white;
	border-left-style: none;
	border-left-width: 0px;
	border-right-color: white;
	border-right-style: none;
	border-right-width: 0px;
	border-top-color: white;
	border-top-style: none;
	border-top-width: 0px;
	color: white;
	cursor: pointer;
	display: inline-block;
	/*font-family: 'Lucida Grande';
	font-size: 18px;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	letter-spacing: normal;
	line-height: normal;  
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	outline-color: white;
	outline-style: none;
	outline-width: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	text-align: center;
	text-indent: 0px;
	text-shadow: none;
	text-transform: none;
	vertical-align: baseline;
	white-space: pre;
	width: 112px;
	height: 60px;
	word-spacing: 0px;
}
div.headmsg
{
	margin-top: 50px;
	width: 400px;
	margin-left: auto;
	margin-right: auto;
	top: 200px;
	font-family: 'Helvetica';
	font-size: 24px;
	line-height: 24px;
	color: #222222;	
}
div.headsubmsg
{
	margin-top: 10px;
	width: 450px;
	margin-left: auto;
	margin-right: auto;
	top: 200px;
	font-family: 'Helvetica';
	font-size: 15px;
	line-height: 15px;
	color: #222222;	
}
div.menu
{
	margin-top: 30px;
	width: 600px;
	margin-left: auto;
	margin-right: auto;
	top: 200px;
	font-family: 'Helvetica';
	font-size: 12px;
	line-height: 18px;
	color: #222222;
}
</style>
<script type="text/javascript">
/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20782753-1']);
  _gaq.push(['_setDomainName', '.vubla.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div class="topbar"></div>
	
	/*
	$loggedin EXPLANATION
	1 = logged in
	0 = not logged in
	-1 = failed login
	
	
	$sendinfocrawlmail = false;
	
	// bool if vubla is enabled or not, null on error
	function isVublaEnabled($wid)
	{
		$meta = VPDO::getVdo(DB_METADATA, DB_USER, DB_PASS);
		
		$q = "Select enabled from webshops where id=" . $meta->quote($wid). " limit 1";
		$enabled = $meta->fetchOne($q);
		
		// Betyder 1 enabled? 110508
		if ($enabled == 1)
		{
			return true;
		} elseif ($enabled == 0) {
			return false;
		} else {
			Log::_n("Can't check if vubla is enabled or not!!<br />return value is neither 1 or 0");
			Log::saveAll('Something is FUCKED in vubla.com/login/index.php');
			exit();	
		}
	}
	
	// check if already logged in
	function getCurrentUser()
	{
		
		if (!isset($_SESSION['session_token']))
		{
			return null;
		}

		$database = DB_METADATA;
		$linkma = mysql_connect('localhost',DB_USER,DB_PASS);
		mysql_select_db($database) or die( "Unable to select database");

		$query = "SELECT email FROM `customers` WHERE session='".mysql_real_escape_string($_SESSION['session_token'],$linkma)."'";

		$result = mysql_query ($query) or die(mysql_error());
		mysql_close($linkma);

		if ((mysql_numrows($result) > 0) && (strlen(mysql_result($result,0,'email')) > 0))
		{
			return mysql_result($result,0,'email');
		} else {
			return null;
		}
	}
	
	function getCurrentWid()
	{
		$meta = VPDO::getVdo(DB_METADATA, DB_USER, DB_PASS);
		$q = "Select wid from customers where email=" . $meta->quote(getCurrentUser()). " limit 1";
		return $meta->fetchOne($q);
	}
	
	
	if (isset($_GET['a']))
	{
		if ($_GET['a'] == 'logout')
		{
			$headmsg = 'Du er nu logget ud';
			
			$email = getCurrentUser();	
			
			if ($email != null)
			{
				$database = DB_METADATA;
				$link = mysql_connect('localhost',DB_USER,DB_PASS);
				mysql_select_db($database) or die( "Unable to select database");
				$query = 'update customers set session="'.mysql_real_escape_string(generateRandomToken(),$link).'" where email="'.mysql_real_escape_string($email,$link).'" limit 1';
				$result = mysql_query ($query) or die(mysql_error());
				
				if ($result == false)
				{
					// it did NOT work
					session_destroy();
					Log::_n("sql returned false, meaning that the UPDATE command in logout action failed");
					Log::saveAll('sql UPDATE failed in logout in vubla.com/login/index.php');
				}

				//$num = mysql_numrows($result);
				mysql_close($link);

				$loggedin = 0;
				session_destroy();
			}
			
		}
	}
	
	if (getCurrentUser() != null)
	{
		$loggedin = 1;
	} else {
		// User is about to login
		if ((isset($_POST['email'])) && (isset($_POST['pwd'])))
		{
		
			$database=DB_METADATA;
			$link = mysql_connect('localhost',DB_USER,DB_PASS);
			mysql_select_db($database) or die( "Unable to select database");
			$query = 'select session from customers where email="' . mysql_real_escape_string($_POST['email'],$link) . '" and pwd="' . mysql_real_escape_string($_POST['pwd'],$link) . '"';
			$result = mysql_query ($query) or die(mysql_error());
		
			$num = mysql_numrows($result);
			mysql_close($link);
		
			if ($num == 1) // there shall be only one entry in the table with that email and that password! 
			{
				$loggedin = 1;
				$session_token = generateRandomToken();
			
				$_SESSION['session_token'] = $session_token;
			
				$database=DB_METADATA;
				$link = mysql_connect('localhost',DB_USER,DB_PASS);
				mysql_select_db($database) or die( "Unable to select database");
				$query = 'update customers set session="'.$session_token.'" where email="' . mysql_real_escape_string($_POST['email'],$link) . '" and pwd="' . mysql_real_escape_string($_POST['pwd'],$link) . '" limit 1';
			
				$result = mysql_query ($query) or die(mysql_error());

				mysql_close($link);
			
			} elseif ($num < 1){
				$loggedin = -1;
				
				Log::_n("email: <pre>".htmlentities($_POST['email'])."</pre><br/>password:<pre> ".htmlentities($_POST['pwd'])."</pre>");
				Log::saveAll('Failed loginattempt (at vubla.com/login/index.php)');
			} else {
					$loggedin = -1;
					
					Log::_n("The following email and password was found more than one time in customers table<br /><br/>email: <pre>".htmlentities($_POST['email'])."</pre><br/>password:<pre> ".htmlentities($_POST['pwd'])."</pre>");
					Log::saveAll('Duplicate users in customers table (loginattempt at vubla.com/login/index.php)');
			}
		} else {
			$loggedin = 0;
		}	
	}
	
	function generateRandomToken()
	{
		return md5(mt_rand(0,999999).mt_rand(0,999999).mt_rand(0,999999).'wop€()%#%_woptifuckingDooOo!!'.mt_rand(0,999999).mt_rand(0,999999).mt_rand(0,999999));
	}
	
	function getMenu()
	{
		$d = displayEnableOptions().'<br /><br />'.getLastCrawler().'<br />'.displayCrawlOptions().'<br /><br />'.displayEditSearchPageLink();
		return $d;
	}
	
	function displayEditSearchPageLink()
	{
		return 'Du kan frit bestemme hvordan søgeresultatet skal se ud.<br /><a href="?a=managesearchresults">Rediger udseendet for søgeresultater</a>';
	}
	
	function displayEnableOptions()
	{
		$d = '';
		
		
		if (hasBeenCrawledOnce() == true)
		{
			$wid = getCurrentWid();
			$d .= 'Vubla er i øjeblikket <b>';

			if (isVublaEnabled($wid) == false)
			{
				$d .= 'de';
				$link = '<a href="?a=setactivation&setenabled=1">Aktiver Vubla</a>';
			} else {
				$link = '<a href="?a=setactivation&setenabled=0">Deaktiver Vubla</a>';
			}
			$d .= 'aktiveret</b> på din webshop.<br/>';
			$d .= $link;
		} else {
			$d .= 'Vubla er i øjeblikket <b>deaktiveret</b> på din webshop.<br />Din webshop <b>skal</b> crawles før du kan aktivere din webshop.<br>Når din webshop er crawlet, aktiverer du vubla, ved at klikke på et link, som kommer her.';
		}
		
		return $d;
	}
	
	function hasBeenCrawledOnce()
	{
		$meta = VPDO::getVdo(DB_METADATA, DB_USER, DB_PASS);
		
		$wid = getCurrentWid();
		
		$sql = "Select last_crawled from crawllist where wid=" . $meta->quote($wid). " limit 1";
		$last_crawled = $meta->fetchOne($sql);
		
		
		if ($last_crawled == 0)
		{
			return false;
		} else {
			return true;
		}
	}
	
	function displayCrawlOptions()
	{
		//return '<a href="?crawlmenow=1">Anmod om crawl</a>';
	}
	
	function getLastCrawler()
	{
		
		$database=DB_METADATA;
		$linkma = mysql_connect('localhost',DB_USER,DB_PASS);
		mysql_select_db($database) or die( "Unable to select database");

		$query = "SELECT wid FROM `customers` WHERE session='".mysql_real_escape_string($_SESSION['session_token'])."'";

		$result = mysql_query ($query) or die(mysql_error());
		//$num = mysql_numrows($result); 
		mysql_close($linkma);

		$wid = mysql_result($result,0,'wid');

		if (strlen($wid) > 0)
		{
			//return $wid
		} else {
			return null;
		}
		
		
		$database=DB_METADATA;
		$linkma = mysql_connect('localhost',DB_USER,DB_PASS);
		mysql_select_db($database) or die( "Unable to select database");

		$query = "SELECT last_crawled FROM `crawllist` WHERE wid='".mysql_real_escape_string($wid)."' limit 1";

		$result = mysql_query ($query) or die(mysql_error());
		//$num = mysql_numrows($result); 
		mysql_close($linkma);

		$timestamp = mysql_result($result,0,'last_crawled');
		
		if ($timestamp == 0)
		{
			return '<b>Din webshop er endnu ikke blevet crawlet.</b><br />Din webshops <b>skal</b> crawles før vubla virker.<br />Husk, at vubla installationsmodulet også <b>skal</b> være<br />installeret før du kan crawle.';
		} else {
			setlocale(LC_ALL, 'danish');

			// Output: fredag 22 december 1978 
			return htmlentities('Sidste crawl skete '.strftime("%A d. %e %B klokken %R",$timestamp));
		}
		
		
	}
	
	function displaySearchField()
	{
		$content = <<<PIECE
		
		
		
PIECE;
		return $content;
	}
	
	function displayManageSearchResults()
	{
		$d = "";
	
		$meta = VPDO::getVdo(DB_METADATA, DB_USER, DB_PASS);
		$sql = "Select wid from customers where email=" . $meta->quote(getCurrentUser()). " limit 1";
		$wid = $meta->fetchOne($sql);
	
		if (isset($_POST['codearea']))
		{
			$meta = VPDO::getVdo(DB_PREFIX.$wid, DB_USER, DB_PASS);
			$sql = 'insert into layouts (html, type) values ('.$meta->quote(htmlentities($_POST['codearea'])).', 0)';
			$meta->exec($sql);
			$d .= 'Din resultatside er nu blevet opdateret.';
		}
		
		$meta = VPDO::getVdo(DB_PREFIX.$wid, DB_USER, DB_PASS);
		$sql = "Select html from layouts where type=0 order by id desc limit 1";
		$html = $meta->fetchOne($sql);
		
		$box = '<br /><br /><br /><br /><div class="renderboxPre" style="width:600px;margin-left: auto;margin-right: auto;"><h1>Rediger udseendet for din søgeresultat-side</h1><br />
		
		På denne side er der mulighed for at ændre på hvordan dine søgeresultater skal præsenteres.<br />
		Der er kort fortalt to muligheder:<br /><br />
		
		<b>1</b> - Redigere farver, teksttype samt teksstørrelser, for produkter på søgeresultatsiden,<br />dvs. den du har i bunden, så gå til kodeboksen.<br /><br />
		<b>2</b> - Opbygge din egen søgeresultatside, således at designet det bliver integreret med<br />designet på din webshop, så skal du downloade vores tekniske vejledning herunder.<br />
		<br />
		
		<a href="http://vubla.com/login/avanceret.doc">Klik her for at downloade tekniske vejledning til avanceret redigering af søgeresultatsiden.</a><br /><br />Hvis du får brug for at genanvende standardopsætningen, så kan du finde den her:<br /><a href="http://vubla.com/downloads/standard_search_result.txt" target="_blank">http://vubla.com/downloads/standard_search_result.txt</a></div><br /><br /><br /><br />
	
		
		<form name="input" action="index.php?a=managesearchresults" method="post">
		<textarea id="codearea" name="codearea" style="width:95%;height:400px;"/>'.html_entity_decode($html).'</textarea><br /><br />
		<input type="submit" value="Opdater og Gem" />
		</form>';
		
		$d .= $box;
		
		$product[1] = new stdClass();
		$product[1]->name = "Kitchenaid";
		$product[1]->price = "6945 DKK";
		$product[1]->image_link = "http://vubla.com/storage/a.jpg";
		$product[1]->url = "";
		$product[1]->buy_link = ""; // not in use
		
		$product[7] = new stdClass();
		$product[7]->name = "Kitchenaid";
		$product[7]->price = "6945 DKK";
		$product[7]->image_link = "http://vubla.com/storage/b.jpg";
		$product[7]->url = "";
		$product[7]->buy_link = ""; // not in use
		
		$product[3] = new stdClass();
		$product[3]->name = "Kitchenaid";
		$product[3]->price = "6945 DKK";
		$product[3]->image_link = "http://vubla.com/storage/c.jpg";
		$product[3]->url = "";
		$product[3]->buy_link = ""; // not in use
		
		$product[4] = new stdClass();
		$product[4]->name = "Kitchenaid";
		$product[4]->price = "6945 DKK";
		$product[4]->image_link = "http://vubla.com/storage/d.jpg";
		$product[4]->url = "";
		$product[4]->buy_link = ""; // not in use
		
		$product[5] = new stdClass();
		$product[5]->name = "Artisan";
		$product[5]->price = "3599 DKK";
		$product[5]->image_link = "http://vubla.com/storage/e.jpg";
		$product[5]->url = "";
		$product[5]->buy_link = ""; // not in use
		
		$product[6] = new stdClass();
		$product[6]->name = "Artisan";
		$product[6]->price = "3599 DKK";
		$product[6]->image_link = "http://vubla.com/storage/f.jpg";
		$product[6]->url = "";
		$product[6]->buy_link = ""; // not in use
		
		$product[2] = new stdClass();
		$product[2]->name = "Artisan";
		$product[2]->price = "3599 DKK";
		$product[2]->image_link = "http://vubla.com/storage/g.jpg";
		$product[2]->url = "";
		$product[2]->buy_link = ""; // not in use
		
		$product[0] = new stdClass();
		$product[0]->name = "Artisan";
		$product[0]->price = "3599 DKK";
		$product[0]->image_link = "http://vubla.com/storage/h.jpg";
		$product[0]->url = "";
		$product[0]->buy_link = ""; // not in use
		
		
		$out = '';
		$content = html_entity_decode($html);
		$content = str_replace('[@produkter_fra]', '1', $content);
		$content = str_replace('[@produkter_til]',  sizeof($product), $content);
		$content = str_replace('[@produkter_total]', sizeof($product), $content);
		$parts = explode("[@produktliste_start]", $content);
		$pre_list = $parts[0];
		$parts = explode("[@produktliste_slut]", $parts[1]);
		$list = $parts[0];
		$post_list = $parts[1];
		$out .= $pre_list;
		$count = 0;

		foreach($product as $row){
			$list_temp = str_replace("[@pris]", $row->price, $list);
			$list_temp = str_replace("[@produkt_navn]", $row->name, $list_temp);
			$list_temp = str_replace("[@produkt_link]", $row->url, $list_temp);
			$list_temp = str_replace("[@billede_sti]",  $row->image_link, $list_temp);
			$list_temp = str_replace("[@k¿b_nu_link]",  $row->buy_link, $list_temp);
			if($count % 2 != 0){

				$list_temp = preg_replace('/\[@kun_ulige_start\](.*)\[@kun_ulige_slut\]/', '$1', $list_temp);
			} else {
				$list_temp = preg_replace('/\[@kun_ulige_start\](.*)\[@kun_ulige_slut\]/', '', $list_temp);
			}
			$out .= $list_temp;
			$count++;
		}	

		$out .= $post_list;
		
		$d .= '<br /><br /><br /><br /><div class="renderbox" style="width:800px;margin-left: auto;margin-right: auto;"><h1>Se hvordan dit resultat vil se ud:</h1><b>OBS!</b> Følgende er et eksempel for produkter og bredde.<br />Bredden her afspejler ikke bredden på din webshop. Bredden på din webshop er afhængig af hvordan din webshop er designet. <a href="mailto:info@vubla.com">Skriv en mail til os, hvis du er i tvivl</a>.<br/>'.$out.'</div>';
		
		return $d;
	}
	
	
	if ($loggedin > 0)
	{
		echo '<div class="headsubmsg">Logget ind som: <b>'.getCurrentUser().'</b>. <a href="?a=logout">Log ud</a> | <a href="'.LOGIN_URL.'">Menu</a></div>';
		
		
		if ((isset($_GET['a'])) && ($_GET['a'] == 'managesearchresults'))
		{
			echo displayManageSearchResults();
		} elseif ((isset($_GET['a'])) && ($_GET['a'] == 'setactivation')) {
			
			if ((isset($_GET['setenabled'])) && (($_GET['setenabled'] == '1') || ($_GET['setenabled'] == '0')))
			{	
				$wid = getCurrentWid();
				
				$return = API::webshopActivationByWid($wid, $_GET['setenabled']);
				
				if ($return == true)
				{
					/*if ($_GET['setenabled'] == '1')  /// duplicate messaging, we skip this one
					{
						$amsg = "Vubla er nu aktiveret";
					} else {
						$amsg = "Vubla er nu deaktiveret";
					
				}
			} else {
				Log::_n("A link might be broken, <br /><br/>setenabled: <pre>".htmlentities($_GET['setenabled']).'</pre><br/>$_GET["a"]:<pre> '.htmlentities($_GET['a'])."</pre>");
				Log::saveAll('Crazy activation attempt at vubla.com/login/index.php');
			}
			
			echo '<div class="menu">'.getMenu().'</div>';
		} elseif ((isset($_GET['crawlmenow'])) && ($_GET['crawlmenow'] == '1')) {
			
			$wid = getCurrentWid();
			
			//$tmpfile = '/var/www/vhosts/vubla.com/classes/scripts/tmp/crawllog_'.$wid.'.txt';
			//$cmd = 'php /var/www/vhosts/vubla.com/classes/scripts/crawl_me_now.php '.$wid.' '.getCurrentUser().' > '.$tmpfile.' &';
			
			//touch($tmpfile);
			//chmod($tmpfile, 0777);
			
			//system($cmd);
			
			//echo $cmd;
			
			echo '<div class="menu">';
			
			echo '<h1>Din anmodning er nu afsendt. Du vil modtage en email snarest.</h1><br /><br />'.getMenu().'</div>';
			
			// koden i bunden af sitet sender mail til brugere om at crawlingen er startet.
			// Står der nede, så at vi ikke skal vente på at den blokker.
			$sendinfocrawlmail = true;
			
		} else {

			echo '<div class="menu">'.getMenu().'</div>';
		}
		
		
	} else {
		if ($loggedin == -1)
		{
			$headmsg = 'Ugyldig email eller kodeord';
		}
		

?>

<div class="headmsg"><?php if (!isset($headmsg)) { echo 'Indtast email og adgangskode'; } else {echo $headmsg;} ?></div><br/>
<div class="main">

<div id="boxframe" class="boxframe">
	
	<form method="post" id="form" action="<?php echo basename($_SERVER['SCRIPT_FILENAME']).'?a=manage'; ?>"> 
		
		
		<br /><br /><br />
		<input type="text" name="email" onblur="
		if (document.getElementById('box2').value == '')
		{
			document.getElementById('box2').value = 'Email';
		}"

		onclick="
		if (document.getElementById('box2').value == 'Email')
		{
			document.getElementById('box2').value = '';
		}" id="box2" value="Email" />
			<br /><br /><br />
			<input type="password" name="pwd" onfocus="replaceT(this);" onblur="
			if (document.getElementById('box3').value == '')
			{
				document.getElementById('box3').value = 'Adgangskode';	
				this.setAttribute('type','text');

			}"

			onclick="
			/*if (document.getElementById('box3').value == 'Adgangskode')
			{
				document.getElementById('box3').value = '';
				this.setAttribute('value','');
				this.setAttribute('type','password');
			}" id="box3" value="1234" />
	
	
		
	<input type="submit" id="submit" onclick="" value="" /> 
	
	
	</form>
</div>
</div>

<?php

	}

	?>
</body>
</html>

<?php
flush();

if ($sendinfocrawlmail == true)
{
	$to      = getCurrentUser();
	
	$subject = 'Vubla crawler nu din webshop';
	$message = "Dit website bliver i dette øjeblik crawlet. Du vil modtage en email når dette er fuldført.<br>Hvis du mod forventning ikke modtager en email indenfor 2 timer, så skriv til os på info@vubla.com.<br><br>med venlig hilsen<br>Vubla teamet";
	//$subject = 'Anmodning om crawl er accepteret';
	//$message = "Dit website bliver i dette øjeblik crawlet. Du vil modtage en email når det er fuldført.\r\nHvor lang tid dette tager for typiske webshops har vi endnu ingen statistik på, men hvis du ikke har modtaget en mail indenfor 6 timer, så skriv til os på info@vubla.com\r\n\r\nHar du spørgsmål, eller andet, så tøv heller ikke med at skrive.\r\n\r\n- Vubla";
	$headers = 'From: info@vubla.com' . "\r\n" .
	    'Reply-To: info@vubla.com' . "\r\n" .
		"Content-Type:text/html; charset=\"utf-8\"\n" .
	    'X-Mailer: vublamailer';
	
	$body = "<html>\n";
    $body .= "<body style=\"font-family:Helvetica, Verdana, Geneva, sans-serif; font-size:12px;\">\n";
    $body .= $message;
    $body .= "</body>\n";
    $body .= "</html>\n";
	
	$bool = mail($to, $subject, $body, $headers);
	
	if (!$bool)
	{
		Log::_n('getCurrentUser(): <pre>'.$to.'</pre>');
		Log::saveAll('[login] Det failede at sende "din crawl er accepteret" mailen ('.$to.')');
	}
}
*/