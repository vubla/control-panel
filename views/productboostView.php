<?php if(!$vars->products_count) : ?>
<p>
	<?php _e('Vi har endnu ikke besøgt din webshop. ');?><br /><?php _e('Hvis din webshop ikke er besøgt inden for en time efter du har installeret modulet til din webshop skal du kontakte info@vubla.com.');?>
	<?php if($vars->isBeeingCrawled){ ?>
	   <br /> <?php _e('Lige nu bliver din webshop besøgt. Hvis vi ikke er færdig inden for et par timer bedes du kontakte info@vubla.com');?>
	
	<?php } ?>
</p>
<?php else : ?>

<script type="text/javascript">
    /*window.onbeforeunload= function(){
        return 'Husk at gemme alle ændringer';
    };*/
</script>
<h1 class="line"><?php _e('Boost dine produkter');?></h1>
<?php echo $this->msg; ?>
<div class="fullcol">

<form method="get" accept-charset="utf-8" action="<?php $this->link('productboost'); ?>">
	<input name="q" type="text" class="search-field" value="<?php echo $_POST['q']; ?>"/> <input class="search" type="submit" value="Søg"/>
</form>

<form method="post" action="<?php $this->link('productboost','save'); ?>">
	<table id="searchlog">
		<tr>
			<th class="left"><?php _e('Produkt ID');?></th>
			<th><?php _e('Produktnavn');?></th>
			<th><?php _e('Tid');?></th>
			<th class="right"><?php _e('Boost');?></th>
		</tr>
	<?php
		$limit = 10;
		$count_products = count($vars->products);
		$total_pages = intval($count_products/$limit);
		if($count_products % $limit) {
			$total_pages++;	
		}
		
		if($total_pages < 1)  {
			$total_pages = 1;	
		}
		
		if(isset($_GET['page'])) {
			$current = $_GET['page'];
			
			if($current > $total_pages) {
				$current = 1;
			}
		}
		else {
			$current = 1;	
		}
	
		$from = $limit*$current-$limit;
		$to = $limit*$current;
		if($current == $total_pages) { $to = $count_products; }
     //   var_dump($vars);
		for($n = $from; $n < $to; $n++) :
			foreach($vars->boosted as $boosted) {
				if($vars->products[$n]->pid == $boosted->product_id) {
					$boost_start_y = date("Y",$boosted->date_start);
					$boost_start_m = (int)date("m",$boosted->date_start);
					$boost_start_d = (int)date("d",$boosted->date_start);

					$boost_end_y = date("Y",$boosted->date_end);
					$boost_end_m = (int)date("m",$boosted->date_end);
					$boost_end_d = (int)date("d",$boosted->date_end);
					
					$boosted = 1;
					break;
				}
				else {
					unset($boost_start_y);
					unset($boost_start_m);
					unset($boost_start_d);

					unset($boost_end_y);
					unset($boost_end_m);
					unset($boost_end_d);
					
					unset($boosted);					
				}
			}
	?>
		<tr>
			<td><?php echo $vars->products[$n]->pid; ?></td>
			<td><?php echo $vars->products[$n]->name; ?></td>
			<td>
				Fra:
				<select name="boost_start_y[<?php echo $vars->products[$n]->id ?>]">
					<?php for($i = date("Y",time()); $i <= date("Y",time())+1; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_start_y) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>
				</select> - 
				<select name="boost_start_m[<?php echo $vars->products[$n]->id ?>]">
					<?php for($i = 1; $i <= 12; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_start_m) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select> - 
				<select name="boost_start_d[<?php echo $vars->products[$n]->id ?>]">
					<?php for($i = 1; $i <= 31; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_start_d) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select>
				Til:
				<select name="boost_end_y[<?php echo $vars->products[$n]->id ?>]">
					<?php for($i = 0; $i < 2; $i++) : ?>
					<option value="<?php echo date("Y",time())+$i; ?>"<?php if($i == $boost_end_y) { ?> selected="selected"<?php } ?>><?php echo date("Y",time())+$i; ?></option>
					<?php endfor; ?>
				</select> - 
				<select name="boost_end_m[<?php echo $vars->products[$n]->id ?>]">
					<?php for($i = 1; $i <= 12; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_end_m) { ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select> - 
				<select name="boost_end_d[<?php echo $vars->products[$n]->id ?>]">
					<?php for($i = 1; $i <= 31; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_end_d) { ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select>
			</td>
			<td><?php if($boosted == 1) { ?><input type="hidden" name="was_boosted[<?php echo $vars->products[$n]->id ?>]" value="1" /><?php } ?><input type="checkbox" value="1" name="boosted[<?php echo $vars->products[$n]->id ?>]" <?php if($boosted == 1) { ?>checked="checked" <?php } ?> /></td>		
		</tr>
	<?php endfor; ?>
		<tr >
			<td class="no-border">Side <?php for($i = 1; $i <= $total_pages; $i++) : if($i != $current) : ?><a href="?page=<?php echo $i; if(isset($_GET['q'])) { echo '&q=' . $_GET['q']; } ?>"><?php echo $i; ?></a>&nbsp;<?php else : echo '<b>'.$i.'</b>&nbsp;'; endif; endfor; ?></td>
		</tr>
		<div class="bg-reset"/>
	</table>
	<input type="submit" class="save <?php echo Language::get()->getIso() ?>" value="Gem" />
	</form>
</div>

<!--<div class="fullcol">
<br />
<br />
	<h2>Boostede</h2>
	<form method="post" action="<?php $this->link('productboost','save'); ?>">
	<table id="searchlog">
		<tr>
			<th class="left">Produkt ID</th>
			<th>Produktnavn</th>
			<th>Tid</th>
			<th class="right">Boost</th>
		</tr>
	<?php
		for($n = 0; $n < count($vars->boosted_products); $n++) :
			foreach($vars->boosted as $boosted) {
				if($vars->boosted_products[$n]->pid == $boosted->product_id) {
					$boost_start_y = date("Y",$boosted->date_start);
					$boost_start_m = (int)date("m",$boosted->date_start);
					$boost_start_d = (int)date("d",$boosted->date_start);

					$boost_end_y = date("Y",$boosted->date_end);
					$boost_end_m = (int)date("m",$boosted->date_end);
					$boost_end_d = (int)date("d",$boosted->date_end);
					
					$boosted = 1;
					break;
				}
				else {
					unset($boost_start_y);
					unset($boost_start_m);
					unset($boost_start_d);

					unset($boost_end_y);
					unset($boost_end_m);
					unset($boost_end_d);
					
					unset($boosted);					
				}
			}
	?>
		<tr>
			<td><?php echo $vars->boosted_products[$n]->pid; ?></td>
			<td><?php echo $vars->boosted_products[$n]->name; ?></td>
			<td>
				Fra:
				<select name="boost_start_y[<?php echo $vars->boosted_products[$n]->id ?>]">
					<?php for($i = date("Y",time()); $i <= date("Y",time())+1; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_start_y) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>
				</select> - 
				<select name="boost_start_m[<?php echo $vars->boosted_products[$n]->id ?>]">
					<?php for($i = 1; $i <= 12; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_start_m) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select> - 
				<select name="boost_start_d[<?php echo $vars->boosted_products[$n]->id ?>]">
					<?php for($i = 1; $i <= 31; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_start_d) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select>
				Til:
				<select name="boost_end_y[<?php echo $vars->boosted_products[$n]->id ?>]">
					<?php for($i = 0; $i < 2; $i++) : ?>
					<option value="<?php echo date("Y",time())+$i; ?>"<?php if($i == $boost_end_y) { ?> selected="selected"<?php } ?>><?php echo date("Y",time())+$i; ?></option>
					<?php endfor; ?>
				</select> - 
				<select name="boost_end_m[<?php echo $vars->boosted_products[$n]->id ?>]">
					<?php for($i = 1; $i <= 12; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_end_m) { ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select> - 
				<select name="boost_end_d[<?php echo $vars->boosted_products[$n]->id ?>]">
					<?php for($i = 1; $i <= 31; $i++) : ?>
					<option value="<?php echo $i; ?>"<?php if($i == $boost_end_d) { ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
					<?php endfor; ?>				
				</select>
			</td>
			<td><?php if($boosted == 1) { ?><input type="hidden" name="was_boosted[<?php echo $vars->boosted_products[$n]->id ?>]" value="1" /><?php } ?><input type="checkbox" value="1" name="boosted[<?php echo $vars->boosted_products[$n]->id ?>]" <?php if($boosted == 1) { ?>checked="checked" <?php } ?> /></td>		
		</tr>
	<?php endfor; ?>
		<div class="bg-reset"/>
	</table>
	<input type="submit" value="Gem" />
	</form>-->
</div>
<?php endif; ?>
