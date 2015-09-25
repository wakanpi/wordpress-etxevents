<?php

    $wpcom_api_key    = defined( 'WPCOM_API_KEY' ) ? constant( 'WPCOM_API_KEY' ) : '';
    $etxtickets_api_host = 'http://api.etxtickets.com/'. ETXEvent::get_api_key();
    $etxtickets_api_port = 80;

    function etxevents_test_mode() {
        return ETXEvent::is_test_mode();
    }

    function etxevents_http_post( $request, $host, $path, $port = 80, $ip = null ) {
        $path = str_replace( '/1.1/', '', $path );

        return ETXEvent::http_post( $request, $path, $ip );
    }