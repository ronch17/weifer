<?php

namespace App;

/**
 * Create Shortcode for inline svgs
 * [svg name="check"]
 */
add_shortcode('svg', function ($icon) {
    return '<i class="svg-icon svg-icon--' . $icon['name'] . '"><svg><use xlink:href="#' . $icon['name'] . '"/></svg></i>';
});
