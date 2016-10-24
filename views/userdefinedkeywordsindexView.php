<h1 class="line"><?php _e('Brugerdefinerede Nøgleord');?></h1>
<h2><?php _e('Overblik');?></h2>

<?php echo $vars->msg; ?>


<?php
if(sizeof($vars->keywords) > 0) {
	echo '<table id="userdefinedkeywords">';
	echo '<tr>';
	    echo '<th>';
	        echo __('Handlinger');
	    echo '</th>';
	    echo '<th>';
	        echo __('Nøgleord');
	    echo '</th>';
	    echo '<th>';
	        echo __('Text');
	    echo '</th>';
	    echo '<th>';
	        echo __('Link URL');
	    echo '</th>';
	echo '</tr>';
	
	foreach ($vars->keywords as $keyword) {
		echo '<tr>';
	        echo '<td>';
	            echo '<a href="'.$this->link('userdefinedkeywords','edit',null,true).'?id='.$keyword->id.'"> '.__('Ændre').' </a>';
	            echo ' | ';
	            echo '<a href="'.$this->link('userdefinedkeywords','delete',null,true).'?id='.$keyword->id.'"> '.__('Slet').' </a>';
	        echo '</td>';
	        echo '<td>';
	            echo $keyword->words;
	        echo '</td>';
	        echo '<td>';
	            echo $keyword->text;
	        echo '</td>';
	        echo '<td>';
	            echo $keyword->url;
	        echo '</td>';
	    echo '</tr>';
	}
	echo '</table>';
} else {
	echo __('Der er ikke nogle brugerdefinerede nøgleord tilknyttet din webshop.<br/>For at få det skal du blot bruge linket herunder.<br/>');
}
?>
<a href="<?php $this->link('userdefinedkeywords','add')?>" class="newword <?php echo Language::get()->getIso() ?>"></a>
