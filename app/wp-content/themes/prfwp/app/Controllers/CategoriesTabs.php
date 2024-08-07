<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class CategoriesTabs extends Controller
{
    private $taxonomyTermsPosts = [];

    private function setTaxonomyTermsPosts($customPostTypeSlug, $taxonomySlug)
    {
        // Query your specified taxonomy to get, in order, each category
        $terms = get_terms($taxonomySlug);
        $index = 0;
        foreach ($terms as $term) {
            $this->taxonomyTermsPosts[] = [
              'id'           => $term->slug,
              'ariaSelected' => $index == 0 ? 'true' : 'false',
              'linkClass'    => $index == 0 ? ' active' : '',
              'tabPaneClass' => $index == 0 ? ' active show' : '',
              'name'         => $term->name,
              'taxonomy'     => $term->taxonomy,
              'description'  => term_description($term->term_id),
              'posts'        => get_posts([
                'nopaging'  => true,
                'post_type' => $customPostTypeSlug,
                'taxonomy'  => $taxonomySlug,
                'term'      => $term->slug,
                'orderby'   => 'id',
                'order'     => 'ASC',
              ]),
            ];
            $index++;
        }

        return $this;
    }

    private function getTaxonomyTermsPosts()
    {
        return $this->taxonomyTermsPosts;
    }

    public function buildTaxonomyTermsArr($customPostTypeSlug, $taxonomySlug)
    {
        $this->setTaxonomyTermsPosts($customPostTypeSlug, $taxonomySlug);

        return $this->getTaxonomyTermsPosts();
    }
}
