<!--
Set the 'controller', 'task', and 'message' vars to their values before rendering this view.

The 'back' and 'backText' vars are optional, but recomended for usability.
Alternatively, 'use backController' and 'backTask' to specify the controller and task for the back link

The 'headerText' is an optional header text 

Use 'posts' to transfer hidden post data such as ids and what not.
-->
<?php
if(isset($vars->headerText)) {
	echo '<h1 class="line">'.$vars->headerText.'</h1>';
}
?>
<div id="container">

<form action="<?php $this->link($vars->controller,$vars->task); ?>" method="post">
	<?php echo $vars->message; ?><br />

	<input type="hidden" name="task" value="<?php echo $vars->task; ?>" />
	<input type="hidden" name="controller" value="<?php echo $vars->controller; ?>" />
    <?php
        foreach($vars->posts as $name => $value) {
            echo '<input type="hidden" name="'.$name.'" value="'.$value.'" /><br/>';
        }
    ?>
	<input type="submit" name="ok" class="ok" value="OK" /> 
	<input type="submit" name="cancel" class="cancel <?php echo Language::get()->getIso() ?>" value="<?php __('Annuller') ?>" /></br></br>
</form>
<?php
	if(isset($vars->backController)) {
		$vars->back = $this->link($vars->backController,$vars->backTask,null,true);
	}
	if(isset($vars->back)) {
		if(!isset($vars->backText) || length($vars->backText) == 0) {
			$vars->backText = __('Tilbage');
		}
		echo "<a href=\"" . $vars->back . "\"> " . $vars->backText . "</a>";
	}
?>
</div>