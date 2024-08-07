<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$ticker = new FieldsBuilder('ticker');
$ticker
  ->addMessage('Ticker displayed', 'Live currency rates ticker from exchangerates.org.uk will be displayed at the bottom of the hero section.');

return $ticker;
