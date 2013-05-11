<?php
/*
Plugin Name: WP Community Contributions
Plugin URI: http://www.ethitter.com/plugins/
Description: List community contributions, such as plugins hosted at WordPress.org.
Author: Erick Hitter
Version: 0.1
Author URI: http://www.ethitter.com/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class WP_Community_Contribs {
	/**
	 * Singleton
	 */
	private static $instance = null;

	/**
	 * Class variables
	 */
	const post_type = 'wp_comm_contribs';

	/**
	 * Silence is golden!
	 */
	private function __construct() {}

	/**
	 * Instantiate singleton
	 */
	public static function get_instance() {
		if ( ! is_a( self::$instance, __CLASS__ ) ) {
			self::$instance = new self;

			self::$instance->setup();
		}

		return self::$instance;
	}

	/**
	 *
	 */
	private function setup() {
		add_action( 'init', array( $this, 'action_init' ) );
	}

	/**
	 *
	 */
	public function action_init() {
		register_post_type( self::post_type, array(
			'label'               => __( 'Contributions', 'wp-community-contribs' ),
			'labels'              => array(
				'name'               => __( 'Contributions', 'wp-community-contribs' ),
				'singular_name'      => __( 'Contribution', 'wp-community-contribs' ),
				'menu_name'          => __( 'Contributions', 'wp-community-contribs' ),
				'all_items'          => __( 'All Contributions', 'wp-community-contribs' ),
				'add_new'            => __( 'Add New', 'wp-community-contribs' ),
				'add_new_item'       => __( 'Add New', 'wp-community-contribs' ),
				'edit_item'          => __( 'Edit Contribution', 'wp-community-contribs' ),
				'new_item'           => __( 'New Contribution', 'wp-community-contribs' ),
				'view_item'          => __( 'View Contribution', 'wp-community-contribs' ),
				'items_archive'      => __( 'Contributions List', 'wp-community-contribs' ),
				'search_items'       => __( 'Search Contributions', 'wp-community-contribs' ),
				'not_found'          => __( 'No contributions found', 'wp-community-contribs' ),
				'not_found_in_trash' => __( 'No trashed contributions', 'wp-community-contribs' ),
				'parent_item_colon'  => __( 'Contributions:', 'wp-community-contribs' ),
			),
			'public'              => true,
			'exclude_from_search' => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'rewrite'             => array(
				'slug' => 'contributions',
			),
			'supports'            => array(
				'title',
				'editor',
				'author',
				'revisions',
			)
		) );

		// Needs a CT for contribution types
		// Rewrite rules for CPT need to be mangled to include contribution type
	}
}

WP_Community_Contribs::get_instance();
