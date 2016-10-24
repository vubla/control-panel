<?php 
	if($this->view == 'views/registerView.php') {
		include(VUBLA_BASE_PATH . '/header.php');
		include($this->view);
		include(VUBLA_BASE_PATH . '/footer.php');
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Vubla</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/core.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/login.css" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" type="text/css">
		<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
		
	</head>

	<body>
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
		<?php include($this->view); ?>
	</body>
</html>
<?php
	}
?>