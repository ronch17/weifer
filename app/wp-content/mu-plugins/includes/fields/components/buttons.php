<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$buttons = new FieldsBuilder('buttons');
$buttons
  ->addRepeater('buttons', ['min' => 1])
  ->addFields(get_field_partial('sub-components.button'))
  ->endRepeater();

return $buttons;
