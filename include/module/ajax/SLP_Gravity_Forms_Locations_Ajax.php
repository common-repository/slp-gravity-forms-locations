<?php

if ( !class_exists( 'SLP_Gravity_Forms_Locations_AJAX' ) ) {
    require_once SLPLUS_PLUGINDIR . '/include/base_class.ajax.php';
    /**
     * Holds the ajax-only code.
     *
     * This allows the main plugin to only include this file in AJAX mode
     * via the slp_init when DOING_AJAX is true.
     *
     * @package StoreLocatorPlus\SLP_Gravity_Forms_Locations\AJAX
     * @author DeBAAT <slp-gfl@de-baat.nl>
     * @copyright 2022 De B.A.A.T. - Charleston Software Associates, LLC
     */
    class SLP_Gravity_Forms_Locations_AJAX extends SLP_BaseClass_AJAX
    {
        //-------------------------------------
        // Methods : Base Override
        //-------------------------------------
        /**
         * Things we do to latch onto an AJAX processing environment.
         *
         * Add WordPress and SLP hooks and filters only if in AJAX mode.
         *
         * WP syntax reminder: add_filter( <filter_name> , <function> , <priority> , # of params )
         *
         * Remember: <function> can be a simple function name as a string
         *  - or - array( <object> , 'method_name_as_string' ) for a class method
         * In either case the <function> or <class method> needs to be declared public.
         *
         * @link https://codex.wordpress.org/Function_Reference/add_filter
         *
         */
        public function do_ajax_startup()
        {
            if ( !$this->is_valid_ajax_action() ) {
                //				return;
            }
            add_action( 'wp_ajax_slp_get_form_data', array( $this, 'filter_ajax_slp_get_form_data' ) );
        }
        
        //-------------------------------------
        // Methods : Custom
        //-------------------------------------
        /**
         * Handle AJAX request to get form data
         */
        public static function filter_ajax_slp_get_form_data()
        {
            $form_id = filter_input( INPUT_GET, 'formId', FILTER_SANITIZE_STRING );
            $result = new stdClass();
            $result->success = true;
            $result->data = GFAPI::get_form( $form_id );
            // Output
            header( 'Content-Type: application/json' );
            echo  json_encode( $result ) ;
            die;
        }
        
        /**
         * Simplify the plugin debugMP interface.
         *
         * Typical start of function call: $this->debugMP('msg',__FUNCTION__);
         *
         * @param string $type
         * @param string $hdr
         * @param string $msg
         */
        function debugMP( $type, $hdr, $msg = '' )
        {
            if ( $type === 'msg' && $msg !== '' ) {
                $msg = esc_html( $msg );
            }
            if ( $hdr !== '' ) {
                $hdr = __CLASS__ . '::' . $hdr;
            }
            SLP_Gravity_Forms_Locations_debugMP(
                $type,
                $hdr,
                $msg,
                NULL,
                NULL,
                true
            );
        }
    
    }
}
