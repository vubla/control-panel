<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Vubla</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/core.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/controlpanel.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/registration.css" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" type="text/css">
		
      <script src="<?php echo LOGIN_URL ?>/js/jquery.js" type="text/javascript"></script>
      <?php foreach($js as $link){ 
          if(strpos($link,'.php',0) !== false){ ?>
               <script type="text/javascript"><?php include ($link); ?></script>   
       <?php } else { ?>
               <script src="<?php echo $link ?>" type="text/javascript"></script> 
        <? }
          ?>
          <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
       
     
      <?php } ?>
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
		<div id="signup-wrap">
			<div id="loggedin-user-info">
				<img src="<?php echo LOGIN_URL; ?>/images/logosmall.png" alt="" align="left"/>
				<?php if($_SESSION['logged']) : ?>
					Logget ind som <b><?php echo $_SESSION['email'] ?></b><br />
					<a href="<?php $this->link('configuration','logout'); ?>">Log ud</a>
				<?php endif; ?>
			</div>
		
			<ul id="conf_steps">
			    
			    <?php
			    $mark = true;
                $i = 1;
                $xtra = '';
             
                if(!isset($vars->stepname) || is_null($vars->stepname)){ $vars->stepname = 'signupstep'; }
                // 'sortfilterstep',
                $steps = array('signupstep','webshopstep','statusstep', 'finalstep','checkoutstep');
                if(is_object(WebshopDbManager::getCurrentType($_SESSION['uid'])) && WebshopDbManager::getCurrentType($_SESSION['uid'])->id != 2)
                {
                
                    $steps = array('signupstep','webshopstep','templatestep','statusstep','sortfilterstep','demostep', 'finalstep','checkoutstep');
                }
			   
			    foreach ($steps as $key => $step) {
				    echo '<li ';
                    if($mark) echo 'class="marked"';
                    if($step == 'checkoutstep') echo ' last';
                    echo '>'.$i++.'</li>'."\n";
                    if($step == $vars->stepname) $mark = false;
			   }
			   ?>
			
			</ul>
			<div id="error_display" style="display: <?php if(!empty($vars->errors)) { echo 'block'; } else { echo 'none'; } ?>">
			<?php
				if(!empty($vars->errors)){
					foreach ($vars->errors as $key => $err) {
						echo $err .'<br />';
					}
				} 
			?>
			</div>
			
			<?php include($this->view); ?>
		</div>
	</body>
</html>

