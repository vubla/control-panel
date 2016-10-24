<h1 class="line"><?php _e('Download');?></h1>
<?php 
if(!isset($_GET['path'])){
$_GET['path'] = 'downloads/';
}
$link = 'http://www.vubla.dk/'.$_GET['path'].'?internal=1&login=1';
echo file_get_contents($link)
?>