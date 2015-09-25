<?php
/**
 * Created by PhpStorm.
 * User: jasontobias
 * Date: 9/25/15
 * Time: 12:23 AM
 */

class ETXEvent {
    const API_HOST = 'rest.etxevents.com';
    const API_PORT = 80;

    private static $initiated = false;

    public static function init() {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }
    }

    /**
     * Initializes WordPress hooks
     */
    private static function init_hooks()
    {
        self::$initiated = true;
    }


    /**
     *  Activates the plugin
     * @ void
     */
    public static function plugin_activation() {
        if ( version_compare( $GLOBALS['wp_version'], ETXEVENT__MINIMUM_WP_VERSION, '<' ) ) {
            load_plugin_textdomain( 'etxevent' );

            $message = '<strong>'.sprintf(esc_html__( 'ETX Events %s requires WordPress %s or higher.' , 'etxevent'),
                    ETXEVENT_VERSION, ETXEVENT__MINIMUM_WP_VERSION ).'</strong> '.sprintf(__(
                    'Please <a href="%1$s">upgrade WordPress</a> to a current version</a>.', 'etxevent'), 'https://codex.wordpress.org/Upgrading_WordPress');

            ETXEvent::bail_on_activation( $message );
        }
    }

    /**
     * Removes all connection options
     * @static
     */
    public static function plugin_deactivation( ) {
        return self::deactivate_key( self::get_api_key() );
    }



    public static function bail_on_activation() {
        if ( version_compare( $GLOBALS['wp_version'], ETXEVENT__MINIMUM_WP_VERSION, '<' ) ) {
            load_plugin_textdomain( 'akismet' );

            $message = '<strong>'.sprintf(esc_html__( 'ETX Events %s requires WordPress %s or higher.' , 'etxevent'), ETXEVENT_VERSION, ETXEVENT__MINIMUM_WP_VERSION ).'</strong> '.sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version</a>.', 'etxevent'), 'https://codex.wordpress.org/Upgrading_WordPress');

            ETXEvent::bail_on_activation( $message );
        }
    }



    public static function get_api_key()  {
        return apply_filters( 'etxevents_get_api_key', defined('WPCOM_API_KEY') ? constant('WPCOM_API_KEY') : get_option('wordpress_api_key') );
    }


    public function is_test_mode()  {

        echo 'TEST MODE';
    }

}