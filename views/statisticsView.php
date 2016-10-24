<?php if(!$vars->isEnabled){ ?>
<div class="fullcol last center" id="activatebar"><?php _e('Du har ikke aktiveret vubla endnu og får dermed ikke glæde af Vubla. <a href="?activate=1" >Aktiver Vubla nu.');?></a></div>
<? } ?>
<?php if($vars->needStatistics){ ?>
<div class="fullcol last center infobar"><?php _e('Hvis din Magento installation er ny og du har begrænset eller ingen søgehistorik, så husk:
<br/><br/>
- Vubla søgemaskinen lærer løbende hvilke ord dine besøgende bruger om dine produkter. Det kræver normalvis, at Vubla er aktiv i din webshop i 1 uge, før søgeresultatet er bedst.
<br/>
- Vubla finder dine attributter ved 2 gange crawl. Derfor vil søgning på attributter først virke efter 2. crawl. Dette tager normalvis 1 uge.
<br/><br/>
Hvis du har spørgsmål, så kontakt os på <a href="mailto:info@vubla.com">info@vubla.com</a>.');?></a></div>
<? } ?>
<h1 class="line"><?php _e('Statistik');?></h1>
<? //$vars->last_crawled = false;?>
<?php if(!$vars->products_count) : ?>
<p>
	<?php _e('Vi har endnu ikke besøgt din webshop.');?> <br /><?php _e('Hvis din webshop ikke er besøgt inden for en time efter du har installeret modulet til din webshop skal du kontakte info@vubla.com.');?>
	<?php if($vars->isBeeingCrawled){ ?>
	   <br /> <?php _e('Lige nu bliver din webshop besøgt. Hvis vi ikke er færdig inden for et par timer bedes du kontakte info@vubla.com');?>
	
	<?php } ?>
</p>
<?php else : ?>

<div class="sixcol">
		
<?php
	$total_searches				=	$vars->number_of_search;
	$total_searches_today		=	$vars->number_of_search_today;
	$searches_without_result	=	$vars->searches_without_result;
	$hit_ratio					=	$vars->hit_ratio;
?>
<table class="stats-table"> 
	<tr> 
		<th class="left"><?php _e('Søg. / I alt');?></th> 
		<th><?php _e('Søg. / 24 timer');?></th>
		<th><?php _e('Søg. u. resultat');?></th>
		<th class="right"><?php _e('Søg. m. resultat');?></th> 
	</tr>
	<tr> 
		<td class="number"><?php echo $total_searches ?></td> 
		<td class="number"><?php echo $total_searches_today ?></td> 
		<td class="number"><?php echo $searches_without_result ?></td> 
		<td class="number no-border green"><?php echo $hit_ratio ?>%</td> 
	</tr>  
</table> 	

<script type="text/javascript">
	$(function () {
		/*
		*Most searched words
		*/
		var popular_words = [<?php
			$i = 0;
			foreach($vars->words as $word) {
				echo '[' . $i . ', ' . $word->count . ']';
				
				if($i != count($vars->words)-1) {
					echo ', ';
				}
				
				if($i != 9) {
					echo ', ';
					$i++;
				}
				else {
					break;
				}
			}
		?>]

		$.plot($('#graph-popular-words'), [
		{
			data: popular_words,
			bars: { show: true },
		}],
		{
			xaxis: { ticks: [<?php
			$i = 0;
			foreach($vars->words as $word) {
				echo '[' . $i . ', "' . htmlspecialchars($word->word) . '"]';
				
				if($i != 9) {
					echo ', ';
					$i++;
				}
				else {
					break;
				}
			}
		?>] }
		}
		);
		
		
		/*
		*Most searched words
		*/
		var words_without_result = [<?php
			$i = 0;
			foreach($vars->searchesNotFound as $word) {
				echo '[' . $i . ', ' . $word->count . ']';
				
				if($i != 9) {
					echo ', ';
					$i++;
				}
				else {
					break;
				}
			}
		?>]

		$.plot($('#graph-no-result'), [
		{
			data: words_without_result,
			bars: { show: true },
		}],
		{
			xaxis: { ticks: [<?php
			$i = 0;
			foreach($vars->searchesNotFound as $word) {
				echo '[' . $i . ', "' . htmlspecialchars($word->q) . '"]';
				
				if($i != 9) {
					echo ', ';
					$i++;
				}
				else {
					break;
				}
			}
		?>] }
		}
		);
	});
</script>



<?php if(count($vars->words) > 0) : ?>		
<h2><?php _e('De ');?><b><?php echo count($vars->words)?></b> <?php _e('mest søgte ord');?></h2>
<div id="graph-popular-words" class="stats-graph"></div>

<table class="search-table">
	<tr>
		<th class="left"><?php _e('Ord');?></th>
		<th class="right"><?php _e('Antal søgninger');?></th>
	</tr>
	<?php 
		foreach($vars->words as $word){
			echo "<tr>\n";		
			echo '<td>'. htmlspecialchars($word->word) . "</td>\n";

			echo '<td>' . $word->count . "</td>\n";


			echo "</tr>\n";
		}

	?>
	<tr class="no-border">
		<td >
		<?php
			if(array_key_exists('SESSION_show_all_words', $_SESSION) && $_SESSION['SESSION_show_all_words']) {
		?>
		<a href="<?php echo $this->link('statistics','standard','?SESSION_show_all_words=0',true); ?>"><?php _e(' Minimér ');?></a>
		<?php
			}else{
		?>
		<a href="<?php echo $this->link('statistics','standard','?SESSION_show_all_words=1',true); ?>"><?php _e(' Vis alle ');?></a>
		<?php
			}
		?>
		</td>
	</tr>
	<div class="bg-reset"/>
</table>

<h2><?php _e('Søgninger der ikke gav resultat');?></h2>
<div id="graph-no-result" class="stats-graph"></div>

<table class="search-table">
	<tr>
		<th class="left"><?php _e('Søge streng');?></th>
		<th class="right"><?php _e('Antal søgninger');?></th>
	</tr>
	<?php 
		foreach($vars->searchesNotFound as $word){
			echo "<tr>\n";		
			echo '<td>'. htmlspecialchars($word->q) . "</td>\n";

			echo '<td>' . $word->count . "</td>\n";


			echo "</tr>\n";
		}

	?>
	<tr>
		<td >
	<?php
	if(array_key_exists('SESSION_show_all_not_found', $_SESSION) &&$_SESSION['SESSION_show_all_not_found']) {
	?>
		<a href="<?php echo $this->link('statistics','standard','?SESSION_show_all_not_found=0',true); ?>"><?php _e(' Minimér ');?></a>
	<?php
		}else{
	?>
	<a href="<?php echo $this->link('statistics','standard','?SESSION_show_all_not_found=1',true); ?>"><?php _e(' Vis alle ');?></a>
	<?php
		}
	?>
		</td>
	</tr>
	<div class="bg-reset"/>
</table>
</div>

<div class="fourcol last">

	<?php if($vars->products_count > 0) { ?>
	<h2><?php _e('Søge-log');?></h2>
	<p>
		<?php _e('De sidste <b>{%a}</b> søgninger var', array('a'=>count($vars->log))); ?>:
	</p>
		
	<table id="searchlog">
		<tr>
			<th class="left"><?php _e('Tid');?></th>
			<th><?php _e('Søgning');?></th>
			<th><?php _e('Antal produkter');?></th>
			<th class="right"><?php _e('Ip adresse');?></th>
		</tr>
	<?php 
		foreach($vars->log as $row){

			//var_dump($row);
			echo "<tr>\n";
			echo '<td>' . $this->datetime($row->time) . "</td>\n";
			
				 //  $to_encoding = "ISO-8859-1";
				   //$from_encoding = "UTF-8";
				   //row->q = iconv($to_encoding, $from_encoding, $row->q);
				
			echo '<td>'.$row->q . "</td>\n";
			if($row->prodids){
				$count = sizeof(explode(',', $row->prodids));
			} else {
				$count = 0;
			}
			echo '<td>' . $count . "</td>\n";
			echo '<td>' . $row->ip . "</td>\n";


			echo "</tr>\n";
		}

	?>
		<tr >
			<td class="no-border"><a href="<?php $this->link('statistics','log'); ?>"><?php _e('Se søge-log');?></a></td>
		</tr>
		<div class="bg-reset"/>
	</table>
	</div>
	<?php }?>	
	
<?php else : ?>
<?php _e('Der er ikke søgt på nogen ord endnu.'); ?>   
<?php endif; ?>
<?php endif; ?>

