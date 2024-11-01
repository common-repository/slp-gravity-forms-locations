<?php

if ( !class_exists( 'SLP_Gravity_Forms_Locations_UI' ) ) {
    require_once SLPLUS_PLUGINDIR . '/include/base_class.userinterface.php';
    /**
     * Holds the UI-only code.
     *
     * This allows the main plugin to only include this file in the front end
     * via the wp_enqueue_scripts call.   Reduces the back-end footprint.
     *
     * @package StoreLocatorPlus\SLP_Gravity_Forms_Locations\AdminUI
     * @author DeBAAT <slp-gfl@de-baat.nl>
     * @copyright 2022 De B.A.A.T. - Charleston Software Associates, LLC
     */
    class SLP_Gravity_Forms_Locations_UI extends SLP_BaseClass_UI
    {
        //-------------------------------------
        // Properties
        //-------------------------------------
        /**
         * This addon pack.
         *
         * @var \SLP_Gravity_Forms_Locations $addon
         */
        public  $addon ;
        //-------------------------------------
        // Methods
        //-------------------------------------
        /**
         * Add WordPress and SLP hooks and filters.
         *
         * WP syntax reminder: add_filter( <filter_name> , <function> , <priority> , # of params )
         *
         * Remember: <function> can be a simple function name as a string
         *  - or - array( <object> , 'method_name_as_string' ) for a class method
         * In either case the <function> or <class method> needs to be declared public.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_filter
         *
         */
        public function add_hooks_and_filters()
        {
            $this->debugMP( 'msg', __FUNCTION__ . ' started JdB' );
            parent::add_hooks_and_filters();
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
