@set($enable get_sub_field('enable') ? " acfm-breadcrumbs" : '' )
@set($component, '' . get_sub_field('style'))

<div class="acfm-{{App::layout()}}{{$contain}}">
  @sub('breadcrumbs')
    <ul class="acfm__list">
      <li><a href="{{ home_url()}}">Home</a></li>
      @php
      $post_id = get_the_ID();
      $post_type = get_post_type($post_id);

      if ($post_type === 'post') {
        // Display category and post title for blog posts
        $categories = get_the_category();
        if ($categories) {
          foreach ($categories as $category) {
            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
          }
        }
        echo '<li>' . get_the_title() . '</li>';
      } elseif ($post_type === 'page') {
        // Display parent pages for static pages
        $ancestors = get_post_ancestors($post_id);
        if ($ancestors) {
          $ancestors = array_reverse($ancestors);
          foreach ($ancestors as $ancestor) {
            echo '<li><a href="' . esc_url(get_permalink($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
          }
        }
        echo '<li><span class="bracket"> > </span>' . get_the_title() . '</li>';
      }
      @endphp
    </ul>

</div>

