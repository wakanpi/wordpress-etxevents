<?php
    /**
     * @package etxevents
     */
    /*
    Plugin Name: ETX Events
    Plugin URI: http://www.etxevents.com/
    Description: ETX Events is a plugin that allows you to access data from the ETX Events Website to include on your own website. This plugin allows you to filter the type of results and location to be specific to your area. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="http://www.etxevents.com/get_api_key/">Sign up for an API key</a>, and 3) Go to your ETX Events configuration page, and save your API key.
    Version: 0.1
    Author: Jason Tobias - Wakanpi Web Services
    Author URI: http://www.etxevents.com/
    License: GPLv2 or later
    Text Domain: ETXEvents
    */

    /*
    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
    */

// Make sure we don't expose any info if called directly
    if ( !function_exists( 'add_action' ) ) {
        echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
        exit;
    }

    define( 'ETXEVENT_VERSION', '0.5' );
    define( 'ETXEVENT__MINIMUM_WP_VERSION', '3.2' );
    define( 'ETXEVENT__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    define( 'ETXEVENT__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

    register_activation_hook( __FILE__, array( 'ETXEvent', 'plugin_activation' ) );
    register_deactivation_hook( __FILE__, array( 'ETXEvent', 'plugin_deactivation' ) );

    require_once( ETXEVENT__PLUGIN_DIR . 'class.etxevents.php' );
//    require_once( ETXEVENT__PLUGIN_DIR . 'class.etxevent-widget.php' );

    add_action( 'init', array( 'ETXEvents', 'init' ) );

    if ( is_admin() ) {
        require_once( ETXEVENT__PLUGIN_DIR . 'class.etxevents-admin.php' );
        add_action( 'init', array( 'ETXEvents_Admin', 'init' ) );
    }

//add wrapper class around deprecated akismet functions that are referenced elsewhere
    require_once( ETXEVENT__PLUGIN_DIR . 'wrapper.php' );