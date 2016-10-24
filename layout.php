<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Vubla</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/core.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/controlpanel.css" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" type="text/css">
		<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo LOGIN_URL ?>/js/excanvas.min.js"></script><![endif]-->
		<script src="<?php echo LOGIN_URL ?>/js/jquery.js" type="text/javascript"></script>
		<script src="<?php echo LOGIN_URL ?>/js/jquery.flot.js" type="text/javascript"></script>
		<script src="<?php echo LOGIN_URL ?>/js/jquery.flot.text.js" type="text/javascript"></script>
		 <?php foreach($js as $link){ 
          if(strpos($link,'.php',0) !== false){ ?>
               <script type="text/javascript"><?php include ($link); ?></script>   
       <?php } else { ?>
               <script src="<?php echo $link ?>" type="text/javascript"></script> 
        <? } }
          ?>
          <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>

		<?php foreach($css as $link){ ?>
		  <link rel="stylesheet" href="<?php echo $link; ?>" type="text/css"> 
		<?php } ?>
	</head>
	<body>
	    <?php foreach($javascript as $script){  ?>
               <script type="text/javascript"><?php echo $script; ?></script>
        <? } ?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-20782753-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
})();
</script>
		<a id="feedback" href="http://www.vubla.com/contact/" target="_blank">Feedback</a>
		
		<div id="header">
			<div class="container">
				<div class="fullcol last">
					<img class="logo" src="<?php echo LOGIN_URL ?>/images/logo2.png" alt="Vubla admin panel" />
					<a href="http://www.vubla.com/support/"><img class="head-nav" src="<?php echo LOGIN_URL ?>/images/help.png" /></a></li>
			</div>
			</div>
		</div>
		<div class="container">
				<div id="sidebar">
					<div id="loged-in"><?php _e('Logget ind som'); ?> <b><span id="username"><?php echo $_SESSION['email'] ?></span></b><a href="<?php $this->link('user','logout'); ?>"><br /><?php _e('Log ud'); ?></a> 
					</div>
				
					<ul id="nav">
					
				
						<li><a href="<?php $this->link('statistics'); ?>"><?php _e('Statistik'); ?></a></li>
					
						<li><a href="<?php $this->link('settings'); ?>"><?php _e('Indstillinger'); ?></a></li>
                 <?php //  <li><a href="<?php $this->link('userdefinedkeywords'); ?><?php //"> Nøgleord</a></li>?>
                  
                  <?php // <li><a href="<?php $this->link('productboost'); ?><?php // ">Boost produkter</a></li>?>
						<li><a href="<?php $this->link('status'); ?>"><?php _e('Status'); ?></a></li>
					<?php // <li><	<li><a href="<?php $this->link('downloads'); ?><?php // <li><">Download</a></li> ?>
						<?php //<li class="no-border"><a href="<?php $this->link('searchlayout', 'view'); "><?php _e('Prøv Vubla'); </a></li>?>
					</ul>
				</div>
							
			<div id="content" class="content">
				<?php include($this->view); ?>
			</div>
		</div>
	</body>
</html>