<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$tabs = new FieldsBuilder('tabs');

$tabs->addRepeater('buttons', ['min' => 1])
      ->addFields(get_field_partial('sub-components.button'))
      ->addText( 'tab_class', [ 'label' => 'tab class' ] )->setWidth( 20 )
      ->endRepeater();

return $tabs;