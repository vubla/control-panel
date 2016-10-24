<?php 

include '../config.php';
include CLASS_FOLDER.'/autoload.php';

autoload::init();
putenv("LANGUAGE=");

language::loadLanguage(2);

 echo setlocale(LC_MESSAGES, 0 );
 echo ' ';
 echo __('description');
