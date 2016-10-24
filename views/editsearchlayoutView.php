<h1 class="line"><?php _e('Templates');?></h1>

<div class="fullcol">
		<?php include('views/edittemplateView.php'); ?>
		<div class="space"></div>
		
		<input type="hidden" name="task" value="edit" />
		<input type="hidden" name="controller" value="searchlayout" />
		<input type="submit" class="save <?php echo Language::get()->getIso() ?>" name="save_attributes" value="Gem" />
	</form>
</div>