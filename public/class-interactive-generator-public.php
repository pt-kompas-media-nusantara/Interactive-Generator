<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Interactive_Generator
 * @subpackage Interactive_Generator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Interactive_Generator
 * @subpackage Interactive_Generator/public
 * @author     Deny Ramanda <denyramanda07@gmail.com>
 */
class Interactive_Generator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $interactive_generator    The ID of this plugin.
	 */
	private $interactive_generator;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $interactive_generator       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $interactive_generator, $version ) {

		$this->interactive_generator = $interactive_generator;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Interactive_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Interactive_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->interactive_generator, plugin_dir_url( __FILE__ ) . 'css/interactive-generator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Interactive_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Interactive_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->interactive_generator, plugin_dir_url( __FILE__ ) . 'js/interactive-generator-public.js', array( 'jquery' ), $this->version, false );

	}

}
