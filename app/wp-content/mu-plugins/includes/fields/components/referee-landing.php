<?php

namespace prfwp;

use StoutLogic\AcfBuilder\FieldsBuilder;

$referee_landing = new FieldsBuilder('referee_landing');

$referee_landing
    ->addUrl('signup_url', ['label' => 'Signup URL'])
    ->setWidth(50)->setDefaultValue(get_site_url() . '/open-account/#')
    ->setInstructions('For HTML5Mode url must have "#" symbol at the end')
    ->addText('reward_message', ['label' => 'Reward Message'])
    ->setWidth(50)->setInstructions('Message for new user');;

return $referee_landing;