<?php

/**
 * Plugin Name:  Store Locator Plus® | Gravity Forms Locations
 * Plugin URI:   https://www.de-baat.nl/slp-gravity-forms-locations/
 * Description:  SLP Gravity Forms Locations is an add-on pack for Store Locator Plus that supports adding basic locations using Gravity Forms.
 * Author:       DeBAAT
 * Author URI:   https://www.de-baat.nl/slp/
 * License:      GPL3
 * Tested up to: 6.1.1
 * Version:      6.1.1
 * 
 * Text Domain:  slp-gravity-forms-locations
 * Domain Path:  /languages/
 * 
 * 
 * Copyright 2022 De B.A.A.T. (slp-gravity-forms-locations@de-baat.nl)
 */
// No direct access allowed outside WordPress
//
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Define some constants for use by this add-on
slp_gfl_maybe_define_constant( 'SLP_GFL_FREEMIUS_ID', '5974' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SHORT_SLUG', 'slp-gravity-forms-locations' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_PREMIUM_SLUG', 'slp-gravity-forms-locations-premium' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ADMIN_PAGE_SLUG', 'slp_gravity_forms_locations' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ADMIN_PAGE_SLUG_FRE', 'slp_gravity_forms_locations-pricing' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_CLASS_PREFIX', 'SLP_Gravity_Forms_Locations_' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_MIN_SLP', '5.5.0' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_FILE', __FILE__ );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_REL_DIR', plugin_dir_path( SLP_GFL_FILE ) );
//
slp_gfl_maybe_define_constant( 'WP_DEBUG_LOG_SLP_GFL', false );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_NO_INSTALLED_VERSION', '0.0.0' );
//
/**
 * Define a constant if it is not already defined.
 *
 * @param string $name  Constant name.
 * @param string $value Value.
 *
 * @since  6.1.1
 */
function slp_gfl_maybe_define_constant( $name, $value )
{
    if ( !defined( $name ) ) {
        define( $name, $value );
    }
}

// Include Freemius SDK integration

if ( function_exists( 'slp_gfl_freemius' ) ) {
    slp_gfl_freemius()->set_basename( true, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    
    if ( !function_exists( 'slp_gfl_freemius' ) ) {
        // Create a helper function for easy SDK access.
        function slp_gfl_freemius()
        {
            global  $slp_gfl_freemius ;
            
            if ( !isset( $slp_gfl_freemius ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $slp_gfl_freemius = fs_dynamic_init( array(
                    'id'               => SLP_GFL_FREEMIUS_ID,
                    'slug'             => SLP_GFL_SHORT_SLUG,
                    'premium_slug'     => SLP_GFL_PREMIUM_SLUG,
                    'type'             => 'plugin',
                    'public_key'       => 'pk_01afeb1e2122e45686c7d259ca487',
                    'is_premium'       => false,
                    'premium_suffix'   => 'Premium',
                    'has_addons'       => false,
                    'has_paid_plans'   => true,
                    'is_org_compliant' => true,
                    'trial'            => array(
                    'days'               => 30,
                    'is_require_payment' => false,
                ),
                    'menu'             => array(
                    'slug'    => SLP_GFL_ADMIN_PAGE_SLUG,
                    'account' => true,
                    'contact' => false,
                    'support' => false,
                    'parent'  => array(
                    'slug' => 'csl-slplus',
                ),
                ),
                    'is_live'          => true,
                ) );
            }
            
            return $slp_gfl_freemius;
        }
        
        // Init Freemius.
        slp_gfl_freemius();
        // Signal that SDK was initiated.
        do_action( 'slp_gfl_freemius_loaded' );
        function slp_gfl_freemius_settings_url()
        {
            return admin_url( 'admin.php?page=' . SLP_GFL_ADMIN_PAGE_SLUG );
        }
        
        slp_gfl_freemius()->add_filter( 'connect_url', 'slp_gfl_freemius_settings_url' );
        slp_gfl_freemius()->add_filter( 'after_skip_url', 'slp_gfl_freemius_settings_url' );
        slp_gfl_freemius()->add_filter( 'after_connect_url', 'slp_gfl_freemius_settings_url' );
        slp_gfl_freemius()->add_filter( 'after_pending_connect_url', 'slp_gfl_freemius_settings_url' );
    }
    
    /**
     * Get the Freemius object.
     *
     * @return string
     */
    function slp_gfl_freemius_get_freemius()
    {
        return freemius( SLP_GFL_FREEMIUS_ID );
    }
    
    
    if ( function_exists( 'slp_gfl_freemius' ) ) {
        slp_gfl_freemius()->set_basename( false, __FILE__ );
        //	return;
    }
    
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX && !empty($_POST['action']) && $_POST['action'] === 'heartbeat' ) {
        return;
    }
    function SLP_Gravity_Forms_Locations_loader()
    {
        require_once 'include/base/loader.php';
    }
    
    add_action( 'plugins_loaded', 'SLP_Gravity_Forms_Locations_loader' );
    function SLP_Gravity_Forms_Locations_Get_Instance()
    {
        global  $slplus ;
        return $slplus->AddOns->get( 'slp-gravity-forms-locations', 'instance' );
    }
    
    function SLP_Gravity_Forms_Locations_admin_menu()
    {
        global  $_registered_pages ;
        $_registered_pages['admin_page_' . SLP_GFL_ADMIN_PAGE_SLUG] = true;
        $_registered_pages['admin_page_' . SLP_GFL_ADMIN_PAGE_SLUG_FRE] = true;
        $_registered_pages[SLP_GFL_ADMIN_PAGE_SLUG_FRE] = true;
    }
    
    function SLP_Gravity_Forms_Locations_admin_init()
    {
        global  $plugin_page ;
        if ( substr( $plugin_page, 0, strlen( SLP_GFL_ADMIN_PAGE_SLUG ) ) === SLP_GFL_ADMIN_PAGE_SLUG ) {
            $plugin_page = SLP_GFL_ADMIN_PAGE_SLUG;
        }
    }
    
    /**
     * Translate the slug for an add_on.
     *
     * @param object $this_addon this object for the addon
     * @param string $addon_slug slug for the addon
     *
     * @return object reference to this addon
     */
    function filter_gfl_slp_get_addon( $this_addon, $addon_slug )
    {
        
        if ( strtolower( $addon_slug ) == 'gravity' || strtolower( $addon_slug ) == 'gravity-forms-locations' || strtolower( $addon_slug ) == 'gravity_forms_locations' ) {
            $this_gfl_addon = SLP_Gravity_Forms_Locations_Get_Instance();
            return $this_gfl_addon;
            return SLP_Gravity_Forms_Locations_Get_Instance();
            global  $slplus ;
            return $slplus->AddOns->get( 'slp-gravity-forms-locations', 'instance' );
        }
        
        return $this_addon;
    }
    
    /**
     * Auto-loads classes whenever new ClassName() is called.
     *
     * Loads them from the module/<submodule> directory for the add on.  <submodule> is the part after the class prefix before an _ or .
     * For example SLP_Power_Admin would load the include/module/admin/SLP_Power_Admin.php file.
     *
     * @param $class_name
     */
    function SLP_Gravity_Forms_Locations_auto_load( $class_name )
    {
        if ( strpos( $class_name, SLP_GFL_CLASS_PREFIX ) !== 0 ) {
            return;
        }
        // Set submodule and file name.
        //
        $prefix = SLP_GFL_CLASS_PREFIX;
        preg_match( "/{$prefix}([a-zA-Z]*)/", $class_name, $matches );
        $file_name = SLP_GFL_REL_DIR . 'include/module/' . (( isset( $matches[1] ) ? strtolower( $matches[1] ) . '/' : '' )) . $class_name . '.php';
        // If the include/module/submodule/class.php file exists, load it.
        //
        if ( is_readable( $file_name ) ) {
            require_once $file_name;
        }
    }
    
    // Register the local SLP_Gravity_Forms_Locations_auto_load
    spl_autoload_register( 'SLP_Gravity_Forms_Locations_auto_load' );
    /**
     * Simplify the plugin debugMP interface.
     *
     * @param string $type
     * @param string $hdr
     * @param string $msg
     */
    function SLP_Gravity_Forms_Locations_debugMP(
        $type = 'msg',
        $header = '',
        $message = '',
        $file = null,
        $line = null,
        $notime = true
    )
    {
        $panel = 'slp.gfl';
        if ( WP_DEBUG_LOG_SLP_GFL ) {
            switch ( strtolower( $type ) ) {
                case 'pr':
                    error_log( 'HDR: ' . $header . ' PR is no MSG ' . print_r( $message, true ) );
                    break;
                default:
                    error_log( 'HDR: ' . $header . ' MSG: ' . $message );
                    break;
            }
        }
        // Panel not setup yet?  Return and do nothing.
        //
        if ( !isset( $GLOBALS['DebugMyPlugin'] ) || !isset( $GLOBALS['DebugMyPlugin']->panels[$panel] ) ) {
            return;
        }
        // Do normal real-time message output.
        //
        switch ( strtolower( $type ) ) {
            case 'pr':
                $GLOBALS['DebugMyPlugin']->panels[$panel]->addPR(
                    $header,
                    $message,
                    $file,
                    $line,
                    $notime
                );
                break;
            default:
                $GLOBALS['DebugMyPlugin']->panels[$panel]->addMessage(
                    $header,
                    $message,
                    $file,
                    $line,
                    $notime
                );
                break;
        }
    }
    
    // Register the additional admin pages!!!
    add_action( 'admin_init', 'SLP_Gravity_Forms_Locations_admin_init', 25 );
    add_action( 'admin_menu', 'SLP_Gravity_Forms_Locations_admin_menu' );
    // ADMIN
    add_action( 'user_admin_menu', 'SLP_Gravity_Forms_Locations_admin_menu' );
    // ADMIN
    // Addon slug translation
    add_filter(
        'slp_get_addon',
        'filter_gfl_slp_get_addon',
        10,
        2
    );
    add_action( 'dmp_addpanel', array( 'SLP_Gravity_Forms_Locations', 'create_DMPPanels' ) );
}
