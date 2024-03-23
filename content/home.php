<?php
// home page content 

?>
<?php

/**=====================================
all post content here 
===================================*/



// First Query: Get the latest three posts
$latest_posts_query = new WP_Query(array(
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC'
));

// Second Query: Get the next three posts from a specific category
$category_posts_query = new WP_Query(array(
    'cat' => 'your_category_id', // Replace 'your_category_id' with the actual category ID
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC'
));

?>

<div class="blog_container">
    <?php


// Output latest posts
if ($latest_posts_query->have_posts()) :
    while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
?>
        <div class="blog_area">
                <div class="post_thumb">
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('post-thumbnails'); ?></a>
                </div>
                <div class="post_details">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php
                    // Get the post excerpt
                    $post_content = get_the_content();

                    // Remove "[...]" from the excerpt
                    $post_excerpt = wp_trim_words($post_content, 20, '');

                    // Output the modified excerpt
                    ?>
                    <a href="<?php the_permalink() ?>" class="text-decoration-none text-dark">
                        <?php echo $post_excerpt; ?>
                    </a>

                    <?php
                    // Get the post time
                    $post_time = get_the_time('U');

                    // Get the human-readable time difference
                    $human_time_diff = human_time_diff($post_time, current_time('U')) . ' ago';

                    ?>
                    <br>
                    <span> <?php echo $human_time_diff; ?></span>
                </div>

            </div>
<?php
    endwhile;
    wp_reset_postdata();
else :
    // No posts found
endif;
// end first 3 latest post show on the page 



    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>

            <div class="blog_area">
                <div class="post_thumb">
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('post-thumbnails'); ?></a>
                </div>
                <div class="post_details">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php
                    // Get the post excerpt
                    $post_content = get_the_content();

                    // Remove "[...]" from the excerpt
                    $post_excerpt = wp_trim_words($post_content, 20, '');

                    // Output the modified excerpt
                    ?>
                    <a href="<?php the_permalink() ?>" class="text-decoration-none text-dark">
                        <?php echo $post_excerpt; ?>
                    </a>

                    <?php
                    // Get the post time
                    $post_time = get_the_time('U');

                    // Get the human-readable time difference
                    $human_time_diff = human_time_diff($post_time, current_time('U')) . ' ago';

                    ?>
                    <br>
                    <span> <?php echo $human_time_diff; ?></span>
                </div>

            </div>

    <?php
        endwhile;
        wp_reset_postdata();
    else :
        _e('No post found');
    endif;
    ?>

    
</div>
<div id="page_nav">
        <?php if ('ikr_page_nave') {
            ikr_page_nave();
        } else {
        ?>
            <?php next_posts_link(); ?>
            <?php previous_posts_link() ?>

        <?php
        } ?>
    </div>