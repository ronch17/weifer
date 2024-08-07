<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$trading_widget = new FieldsBuilder('trading_widget');
$trading_widget
    ->addTextarea('trading_widget', ['label' => 'Script for Widget']);


return $trading_widget;
