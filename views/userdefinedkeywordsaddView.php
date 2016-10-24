<h1 class="line"><?php _e('Brugerdefinerede Nøgleord');?></h1>
<h2><?php _e('Nyt Nøgleord');?></h2>

<?php echo $vars->msg; ?>

<form id="settings-form" action="<?php $this->link('userdefinedkeywords','add'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $vars->keyword->id;?>" />
    <table width="100%">
        <tr>
            <td>
                <?php _e('Nøgleord');?><br/><?php _e('(komma separeret)');?>
            </td>
            <td>
                <input type="text" name="words" value="<?php echo $vars->keyword->words;?>" />
            </td>
        </tr>
            <td>
                <?php _e('Text');?>
            </td>
            <td>
                <input type="text" name="text" value="<?php echo $vars->keyword->text;?>" />
            </td>
        </tr>
        <tr>
            <td>
                <?php _e('Link URL');?>
            </td>
            <td>
                <input type="text" name="url" value="<?php echo $vars->keyword->url;?>" />
            </td>
        </tr>
    </table>
<input type="submit" name="submit" value="Gem" class="save <?php echo Language::get()->getIso() ?>" /><br /><br />
</form>
<a href="<?php $this->link('userdefinedkeywords'); ?>"><?php _e('Tilbage');?></a>
