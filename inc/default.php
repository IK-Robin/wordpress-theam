<?php

// Theme Title
add_theme_support('title-tag');

// Thumbnail Image Area
add_theme_support('post-thumbnails', array('page', 'post'));
add_image_size('post-thumbnails', 200, 200, true);
// Excerpt to 40 Words




// ikr_excerpt_more
function ikr_excerpt_more($more) {
  global $post; // Access the global $post variable

  // Check if $post is valid before accessing its properties
  if ($post instanceof WP_Post && isset($post->ID)) {
    return '<br> <br> <a class="redmore" href="' . get_permalink($post->ID) . '">' . 'Read More' . '</a>';
  } else {
    return $more; // Return the default more link if $post is not valid
  }
}
add_filter('excerpt_more', 'ikr_excerpt_more');

function ikr_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'ikr_excerpt_length', 999);


// pageNave function
function ikr_page_nave(){
global $wp_query, $wp_rewrite;
$pages ='';
$max = $wp_query -> max_num_pages;
if(!$current = get_query_var('paged')) $current = 1;
$args['base'] = str_replace(99999999999999,'%#%',get_pagenum_link(99999999999999));
$args['total'] = $max;
$args['current'] = $current;
$total= 1;
$args['prev_text'] ='Prev';
$args['next_text'] = 'Next';
if ($max > 1) echo '</pre>
<div class="wp_pagenav">';
  if ($total == 1 && $max > 1) $pages = '<p class="pages"> Page ' .$current . '<span>of</span>' . $max . '</p>';
  echo $pages . paginate_links($args);
  if ($max > 1 ) echo '</div><pre>';
}