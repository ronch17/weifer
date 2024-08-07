<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Glossary extends Controller
{
    static public function atoz() {
        global $post;

        $args = array(
          'post_type'           => 'glossary',
          'posts_per_page'      => '-1',
          'orderby'             => 'title',
          'order'               => 'ASC',
          'ignore_sticky_posts' => 1,
        );

        $glossaries = get_posts($args);

        $atoz = [];

        foreach ($glossaries as $post) : setup_postdata($post);
            $title = get_the_title();
            $alpha = strtolower(apply_filters('shortcode_atoz_alpha', mb_substr($title, 0, 1, 'UTF-8')));

            $link = '<h5 class="glossary-atoz__item__title">' . $title . '</h5>'; // Default to text only

            $edit = self::get_edit_post_link_btn();

            $content = apply_filters('the_content', get_the_content());
            $content = '<span class="glossary-atoz__item__content">' . $content . '</span>';

            $item = '<li class="glossary-atoz__item">';
            $item .= $link . $content . $edit;
            $item .= '</li>';

            $atoz[$alpha][] = $item;
        endforeach;
        wp_reset_postdata();

        return $atoz;
    }

    static private function get_edit_post_link_btn($text = null, $before = '', $after = '', $id = 0, $class = 'post-edit-link')
    {
        if ( ! $post = get_post($id)) {
            return;
        }

        if ( ! $url = get_edit_post_link($post->ID)) {
            return;
        }

        if (null === $text) {
            $text = __('Edit');
        }

        $link = '<a class="' . esc_attr($class) . '" href="' . esc_url($url) . '">' . $text . '</a>';

        /**
         * Filters the post edit link anchor tag.
         *
         * @since 2.3.0
         *
         * @param string $link Anchor tag for the edit link.
         * @param int $post_id Post ID.
         * @param string $text Anchor text.
         */
        return $before . apply_filters('edit_post_link', $link, $post->ID, $text) . $after;
    }
}
