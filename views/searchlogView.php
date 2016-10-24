<h1 class="line"><?php _e('Søgeloggen');?></h1>
<p><a href="<?php $this->link('statistics'); ?>"><?php _e('Tilbage til statistik');?></a></p>
<div class="nine-column">
<table id="searchlog">
<tr>
<th><?php _e('Tid');?></th>
<th><?php _e('Søgning');?></th>
<th><?php _e('Rettet til');?></th>
<th><?php _e('Mente du?');?></th>
<th><?php _e('Antal fundne produkter');?></th>
<th><?php _e('Ip addresse');?></th>
</tr>
<?php //Migrate to partial view??
foreach($vars->log as $row){

    //var_dump($row);
    echo '<tr>';
    echo '<td>' . date("d M H:i",$row->time) . '</td>';
    
	     //  $to_encoding = "ISO-8859-1";
	       //$from_encoding = "UTF-8";
	       //row->q = iconv($to_encoding, $from_encoding, $row->q);
	    
    echo '<td>'.$row->q . '</td>';
    echo '<td>'.$row->what_you_mean . '</td>';
    echo '<td>'.$row->did_you_mean . '</td>';
    if($row->prodids){
        $count = sizeof(explode(',', $row->prodids));
    } else {
        $count = 0;
    }
    echo '<td>' . $count . '</td>';
	echo '<td>' . $row->ip . '</td>';


    echo '</tr>';
}

?>
</table>
<?php if($_SESSION['SESSION_show_entire_log']) {?>
	<a href="<?php echo $this->link('statistics','log').'?SESSION_show_entire_log=0'?>"><?php _e('Kollaps');?></a>
<?php } else {?>
	<a href="<?php echo $this->link('statistics','log').'?SESSION_show_entire_log=1'?>"><?php _e('Vis hele loggen');?></a>
<?php } ?>
</div>