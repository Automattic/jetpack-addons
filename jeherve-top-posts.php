<?php
/**
 * Plugin Name: Top Posts
 * Plugin URI: http://jetpack.com
 * Description: Get a list of the top 20 most popular posts in the past week.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: http://jeremy.hu
 * License: GPL2+
 * textdomain: jeherve-top-posts
 *
 * @package Jeherve_Top_Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Top Posts Widget.
 *
 * Displays a list of the top 20 most popular posts in the past week.
 *
 * @since 1.0.0
 */
class Jeherve_Top_Posts_Widget extends WP_Widget {

	/**
	 * Constructor
	 */
	function __construct() {
		$widget_ops = array(
			'classname' => 'jeherve-top-posts',
			'description' => __( 'Show the top 20 posts for your site.', 'jeherve-top-posts' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct(
			'jeherve-top-posts',
			__( 'Top Posts', 'jeherve-top-posts' ),
			$widget_ops
		);
	}

	/**
	 * Return an associative array of default values
	 *
	 * These values are used in new widgets.
	 *
	 * @return array Array of default values for the Widget's options
	 */
	public function defaults() {
		return array(
			'title' => __( 'Top Posts', 'jeherve-top-posts' ),
		);
	}

	/**
	 * Get Top Posts from Jetpack.
	 *
	 * @since 1.0.0
	 *
	 * @uses stats_get_from_restapi(). That function caches data locally for 5 minutes.
	 *
	 * @return array $popular_posts Array of the most popular posts on the site.
	 */
	public function get_top_posts() {
		// Start with an empty array.
		$popular_posts = array();

		// Return early if we use a too old version of Jetpack.
		if ( ! function_exists( 'stats_get_from_restapi' ) ) {
			return $popular_posts;
		}

		// Look for data in our transient. If nothing, let's get a new list of posts.
		$data_from_cache = get_transient( 'jeherve_top_posts' );
		if ( false === $data_from_cache ) {
			// Options. We'll get the 20 most popular posts in the past week.
			$args = array(
				'max' => 20,
				'period' => 'week',
			);
			// Get the data.
			$popular_posts_data = stats_get_from_restapi( $args, 'top-posts' );

			if (
				isset( $popular_posts_data )
				&& ! empty( $popular_posts_data )
				&& isset( $popular_posts_data->date )
			) {
				$data_date = $popular_posts_data->date;
				$popular_posts = $popular_posts_data->days->$data_date->postviews;
			} else {
				return $popular_posts;
			}

			// Cache our data for 30 minutes.
			set_transient( 'jeherve_top_posts', $popular_posts, 30 * MINUTE_IN_SECONDS );
		} else {
			$popular_posts = $data_from_cache;
		}

		return $popular_posts;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return void
	 */
	function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults() );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'jeherve-top-posts' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = wp_kses( $new_instance['title'], array() );

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults() );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		// Get the Top Posts
		$popular_posts = $this->get_top_posts();

		if ( ! empty( $popular_posts ) ) {
			/**
			* Display that data however way you want!
			* You have access to the post ID, the URL, the post date, the post title, the post type, the number of views.
			*/
			var_dump( $popular_posts );
		} else {
			esc_html_e( 'Nothing. Maybe write some more?', 'jeherve-top-posts' );
		}

		echo $args['after_widget'];
	}
}

/**
 * If the Stats module is active in a recent version of Jetpack, register the widget.
 *
 * @since 1.0.0
 */
function jeherve_top_posts_widget_init() {
	if ( function_exists( 'stats_get_from_restapi' ) ) {
		register_widget( 'Jeherve_Top_Posts_Widget' );
	}
}
add_action( 'widgets_init', 'jeherve_top_posts_widget_init' );
