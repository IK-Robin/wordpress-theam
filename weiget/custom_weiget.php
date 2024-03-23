<?php 

// add custom widget for add 3 post from catagory  

// Register the custom widget
function custom_category_posts_widget_init() {
    register_widget( 'Custom_Category_Posts_Widget' );
}
add_action( 'widgets_init', 'custom_category_posts_widget_init' );

// Define the widget class
class Custom_Category_Posts_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        $widget_ops = array(
            'classname' => 'custom_category_posts_widget',
            'description' => 'Display posts from a selected category.'
        );
        parent::__construct( 'custom_category_posts_widget', 'Custom Category Posts Widget', $widget_ops );
    }

    // Widget form
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $category_id = isset( $instance['category_id'] ) ? $instance['category_id'] : 0;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category_id' ); ?>">Category:</label>
            <?php wp_dropdown_categories( array(
                'show_option_all' => 'Select a category',
                'name' => $this->get_field_name( 'category_id' ),
                'selected' => $category_id
            ) ); ?>
        </p>
        <?php
    }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['category_id'] = ( !empty( $new_instance['category_id'] ) ) ? intval( $new_instance['category_id'] ) : 0;
        return $instance;
    }

    // Display the widget
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $category_id = $instance['category_id'];

        echo $args['before_widget'];
        if ( !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $category_posts = new WP_Query( array(
            'cat' => $category_id,
            'posts_per_page' => 5 // You can adjust the number of posts to display
        ) );

        if ( $category_posts->have_posts() ) {
            echo '<ul>';
            while ( $category_posts->have_posts() ) {
                $category_posts->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo 'No posts found.';
        }

        echo $args['after_widget'];
    }
}
