<?php 
    // home page content 

?>
<?php 

/**=====================================
all post content here 
===================================*/

?>

  <div class="blog_container">
          <?php
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
          else :
            _e('No post found');
          endif;
          ?>

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
        </div>