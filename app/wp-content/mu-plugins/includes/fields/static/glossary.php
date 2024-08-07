<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$glossary
  = new FieldsBuilder('glossary', ['title' => 'Glossary']);

$glossary
  ->addMessage('Glossary', '"Glossary" will appear in this section');

return $glossary;
