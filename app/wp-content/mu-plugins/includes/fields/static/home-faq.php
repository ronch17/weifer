<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$home_faq
  = new FieldsBuilder('home_faq', ['title' => 'FAQ to Show in home']);

$home_faq
  ->addMessage('FAQ to Show in home', '"FAQ to Show in home" will appear in this section');

return $home_faq;
