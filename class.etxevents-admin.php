<?php

class ETXEvents_Admin
{
    const NONCE = 'extevents-update-key';

    private static $initiated = false;
    private static $notices = array();

    public static function init()
    {
        if (!self::$initiated) {
            self::init_hooks();
        }

        if (isset($_POST['action']) && $_POST['action'] == 'enter-key') {
            self::enter_api_key();
        }
    }

    public static function init_hooks()
    {

        self::$initiated = true;

        add_action('admin_init', array('ETXEvents_Admin', 'admin_init'));
        add_action( 'admin_menu', array( 'ETXEvents_Admin', 'admin_menu' ), 5 );
        add_filter( 'plugin_action_links_'.plugin_basename( plugin_dir_path( __FILE__ ) . 'etxevents.php'), array( 'ETXEvents_Admin', 'admin_plugin_settings_link' ) );
    }


    public static function admin_init()  {
        echo 'ADMIN INIT';
    }

    public static function admin_menu()  {
        echo 'ADMIN MENU';
    }

    public static function admin_plugin_settings_link($links)  {
        $settings_link = '<a href="'.esc_url( self::get_page_url() ).'">'.__('Settings', 'etxevents').'</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    public static function get_page_url( $page = 'config' )
    {

        $args = array('page' => 'etxevents-config');

        $url = add_query_arg( $args, class_exists( 'Jetpack' ) ? admin_url( 'admin.php' ) : admin_url( 'options-general.php' ) );

        return $url;
    }
}