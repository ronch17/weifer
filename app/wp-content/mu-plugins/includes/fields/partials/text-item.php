<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$text_item = new FieldsBuilder('text_item');
$text_item
  ->addWysiwyg('text');

return $text_item;
