<?php

defined( 'ABSPATH' ) || exit;
require_once SLPLUS_PLUGINDIR . 'include/module/admin_tabs/SLP_BaseClass_Admin.php';
/**
 * Holds the admin-only code.
 *
 * This allows the main plugin to only include this file in admin mode
 * via the admin_menu call.   Reduces the front-end footprint.
 *
 * @property        SLP_Gravity_Forms_Locations                     $addon
 * @property        SLP_Gravity_Forms_Locations_Activation          $activation           The activation object.
 * @property        SLP_Gravity_Forms_Locations_Admin_Settings      $gfl_admin_settings   The settings tab.
 */
class SLP_Gravity_Forms_Locations_Admin extends SLP_BaseClass_Admin
{
    protected  $class_prefix = 'SLP_Gravity_Forms_Locations_' ;
    /**
     * This addon pack.
     *
     * @var \SLP_Gravity_Forms_Locations $addon
     */
    public  $addon ;
    public  $gfl_activation ;
    public  $gfl_admin_settings ;
    public  $settings ;
    public  $settings_interface ;
    public  $settings_pages = array(
        'slp_gravity_forms_locations' => array(
        'gfl_skip_geocoding',
        'gfl_duplicates_handling',
        'gfl_form_id',
        'gfl_form_id_selector',
        'label_for_gfl_form_id_selector',
        'search_by_gfl_form_id_pd_label',
        'search_for_none_gfl_form_id_pd_label',
        'gfl_show_gfl_buttons',
        'gfl_allow_gfl_buttons'
    ),
    ) ;
    /**
     * @var SLP_Gravity_Forms_Locations_Admin_Experience $experience
     */
    private  $experience ;
    //-------------------------------------
    // Methods : Base Override
    //-------------------------------------
    /**
     * Execute some admin startup things for this add-on pack.
     *
     * Base plugin override.
     */
    function do_admin_startup()
    {
        $this->debugMP( 'msg', __FUNCTION__ );
        parent::do_admin_startup();
    }
    
    /**
     * Hooks and Filters for this plugin.
     *
     * Base plugin override.
     */
    function add_hooks_and_filters()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started JdB' );
        parent::add_hooks_and_filters();
        // Create admin objects
        $this->create_object_gfl_admin_settings();
        // Load objects based on which admin page we are on.
        //
        if ( isset( $_REQUEST['page'] ) ) {
            switch ( $_REQUEST['page'] ) {
                case SLP_GFL_ADMIN_PAGE_SLUG:
                    add_filter( 'wpcsl_admin_slugs', array( $this, 'filter_AddOurAdminSlug' ) );
                    break;
                case 'slp_info':
                    $this->create_object_gfl_admin_info();
                    break;
                case 'slp_manage_locations':
                    break;
            }
        }
        // Queue scripts for all admin pages
        add_action( 'admin_enqueue_scripts', array( $this, 'action_EnqueueAdminScriptsGFL' ) );
    }
    
    /**
     * Create and attach the admin info object.
     */
    private function create_object_gfl_admin_info()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        if ( !isset( $this->info ) ) {
            $this->info = new SLP_Gravity_Forms_Locations_Admin_Info( array(
                'addon' => $this->addon,
                'admin' => $this,
            ) );
        }
    }
    
    /**
     * Create the settings interface object and attach to this->gfl_admin_settings
     */
    function create_object_gfl_admin_settings()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        
        if ( !isset( $this->gfl_admin_settings ) ) {
            $this->gfl_admin_settings = new SLP_Gravity_Forms_Locations_Admin_Settings( array(
                'addon' => $this->addon,
                'admin' => $this,
            ) );
            $this->debugMP( 'msg', __FUNCTION__ . ' SLP_Gravity_Forms_Locations_Admin_Settings created.' );
        }
    
    }
    
    /**
     * Create the activation object and attach to this->gfl_activation
     */
    function create_object_gfl_activation()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        
        if ( !isset( $this->gfl_activation ) ) {
            $this->gfl_activation = new SLP_Gravity_Forms_Locations_Activation( array(
                'addon' => $this->addon,
                'admin' => $this,
            ) );
            $this->debugMP( 'msg', __FUNCTION__ . ' SLP_Gravity_Forms_Locations_Activation created.' );
        }
    
    }
    
    /**
     * If there is a newer version get the link.
     *
     * @return string
     */
    public function get_newer_version()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        $this->debugMP( 'msg', __FUNCTION__ . ' TODO: Replace with Freemius function.' );
        return '';
        return 'get_newer_version TODO: Replace with Freemius function.';
    }
    
    /**
     * Creates the string to use a name for the setting.
     *
     */
    function create_SettingsSetting( $settingName, $settingAction, $settingID = '' )
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' settingName = ' . $settingName . ', settingID = ' . $settingID . '.' );
        return $settingAction . SLP_GFL_CSL_SEPARATOR . $settingName . SLP_GFL_CSL_SEPARATOR . $settingID;
    }
    
    /**
     * Get the string used as name for the setting.
     *
     */
    function get_SettingsSettingKey( $settingKey, $settingAction, $settingID = '' )
    {
        $this->debugMP( 'msg', __FUNCTION__, ' settingKey = ' . $settingKey . ', settingID = ' . $settingID . '.' );
        $keyPattern = '#^.*' . $settingAction . SLP_GFL_CSL_SEPARATOR . '(.*)' . SLP_GFL_CSL_SEPARATOR . '.*#';
        $keyReplacement = '\\1';
        $newSettingKey = preg_replace( $keyPattern, $keyReplacement, $settingKey );
        $this->debugMP( 'msg', '', ' keyPattern = ' . $keyPattern . ', keyReplacement = ' . $keyReplacement . '.' );
        $this->debugMP( 'msg', '', ' settingKey = ' . $settingKey . ', newSettingKey = ' . $newSettingKey . '.' );
        return $newSettingKey;
    }
    
    //-------------------------------------
    // Methods : Custom : Actions
    //-------------------------------------
    /**
     * Add our admin pages to the valid admin page slugs.
     *
     * @param string[] $slugs admin page slugs
     * @return string[] modified list of admin page slugs
     */
    function filter_AddOurAdminSlug( $slugs )
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        return array_merge( $slugs, array( $this->addon->short_slug, SLP_ADMIN_PAGEPRE . $this->addon->short_slug ) );
    }
    
    /**
     * Add meta links specific for this AddOn.
     *
     * @param string[] $links
     * @param string   $file
     *
     * @return string
     */
    function add_meta_links( $links, $file )
    {
        
        if ( $file == $this->addon->slug ) {
            // Add Documentation support_url link
            $link_text = __( 'Documentation', 'slp-gravity-forms-locations' );
            $links[] = sprintf(
                '<a href="%s" title="%s" target="store_locator_plus">%s</a>',
                SLP_GFL_SUPPORT_URL,
                $link_text,
                $link_text
            );
            // Add Settings link
            $link_text = __( 'Settings', 'slp-gravity-forms-locations' );
            $links[] = sprintf(
                '<a href="%s" title="%s">%s</a>',
                admin_url( 'admin.php?page=' . SLP_GFL_ADMIN_PAGE_SLUG ),
                $link_text,
                $link_text
            );
            // $newer_version = $this->get_newer_version();
            // if ( ! empty( $newer_version ) ) {
            // $links[] = '<strong>' . sprintf( __( 'Version %s in production ', 'slp-gravity-forms-locations' ), $newer_version ) . '</strong>';
            // }
        }
        
        return $links;
    }
    
    /**
     * Deactivate any plugins that this add-on replaces.
     */
    private function deactivate_replaced_addons()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
        $replaced_addons = array( 'store-locator-plus-gravity-forms-locations-free', 'slp-gravity-forms-integration' );
        foreach ( $replaced_addons as $addon_slug ) {
            
            if ( $this->slplus->AddOns->get( $addon_slug, 'active' ) ) {
                deactivate_plugins( $this->slplus->AddOns->instances[$addon_slug]->file );
                $this->slplus->Helper->add_wp_admin_notification( sprintf( __( 'The %s add-on deactivated the conflicting %s add-on. ', 'slp-gravity-forms-locations' ), $this->addon->name, $this->slplus->AddOns->instances[$addon_slug]->name ) );
            }
        
        }
    }
    
    /**
     * Deactivate the competing add-on packs.
     */
    function update_install_info()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        //		parent::update_install_info();
        $this->deactivate_replaced_addons();
        // Do a check on the activation update
        $this->create_object_gfl_activation();
        $this->gfl_activation->update();
    }
    
    /**
     * Enqueue the admin scripts.
     *
     * @param string $hook
     */
    function action_EnqueueAdminScriptsGFL( $hook )
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' hook=' . $hook );
        wp_enqueue_script( 'slp_gfl_script', $this->addon->url . '/js/gfl_gravityforms.js' );
        // Load up the gfl_admin.css style sheet
        //
        wp_register_style( 'slp_gfl_style', $this->addon->url . '/css/gfl_admin.css' );
        wp_enqueue_style( 'slp_gfl_style' );
        wp_enqueue_style( SLP_Admin_UI::get_instance()->styleHandle );
    }
    
    /**
     * Create the country drop down input for the search form.
     */
    function createstring_GFLFormIDDropDown()
    {
        $this->debugMP( 'msg', __FUNCTION__ );
        return "<div id='addy_in_gfl_form_id' class='search_item'>" . "<select id='sl_assign_gfl_form_id' name='sl_assign_gfl_form_id'>" . $this->addon->createstring_GFLFormIDDropDownOptions() . '</select>' . '</div>';
    }
    
    /**
     * Tag a location
     *
     * @param string $action = add or remove
     */
    function gfl_LocationsBulkActionSetGFLFormID( $location_IDs = '', $newGFLFormIDValue = '' )
    {
        global  $wpdb ;
        $this->debugMP( 'pr', __FUNCTION__ . ' started for location_IDs: ', $location_IDs );
        //assigning or removing newGFLFormIDValue for specified locations
        //
        // Make an array of locationIDs
        $theLocations = ( !is_array( $location_IDs ) ? array( $location_IDs ) : ($theLocations = $location_IDs) );
        // Define the new value to use
        $newValues = array();
        $newValues[SLP_GFL_FORMS_ID_SLUG] = $newGFLFormIDValue;
        // Process locationIDs Array
        //
        foreach ( $theLocations as $locationID ) {
            $this->slplus->currentLocation->set_PropertiesViaDB( $locationID );
            $this->slplus->database->extension->update_data( $this->slplus->currentLocation->id, $newValues );
        }
        $this->slplus->notifications->display();
    }
    
    /**
     * Get the fields registered for a location
     *
     */
    public function get_location_fields()
    {
        // The default location fields we want to map for GravityForms
        $location_fields = array(
            'sl_store'       => __( 'Name', 'slp-gravity-forms-locations' ),
            'sl_address'     => __( 'Address', 'slp-gravity-forms-locations' ),
            'sl_address2'    => __( 'Address 2', 'slp-gravity-forms-locations' ),
            'sl_city'        => __( 'City', 'slp-gravity-forms-locations' ),
            'sl_state'       => __( 'State', 'slp-gravity-forms-locations' ),
            'sl_zip'         => __( 'Zip', 'slp-gravity-forms-locations' ),
            'sl_country'     => __( 'Country', 'slp-gravity-forms-locations' ),
            'sl_tags'        => __( 'Tags', 'slp-gravity-forms-locations' ),
            'sl_image'       => __( 'Image', 'slp-gravity-forms-locations' ),
            'sl_description' => __( 'Description', 'slp-gravity-forms-locations' ),
            'sl_email'       => __( 'Email', 'slp-gravity-forms-locations' ),
            'sl_url'         => $this->slplus->WPML->get_text( 'label_website', $this->slplus->WPOption_Manager->get_wp_option( 'label_website', __( 'Website', 'slp-gravity-forms-locations' ) ), 'slp-gravity-forms-locations' ),
            'sl_hours'       => $this->slplus->WPML->get_text( 'label_hours', $this->slplus->WPOption_Manager->get_wp_option( 'label_hours', __( 'Hours', 'slp-gravity-forms-locations' ) ), 'slp-gravity-forms-locations' ),
            'sl_phone'       => $this->slplus->WPML->get_text( 'label_phone', $this->slplus->WPOption_Manager->get_wp_option( 'label_phone', __( 'Phone', 'slp-gravity-forms-locations' ) ), 'slp-gravity-forms-locations' ),
            'sl_fax'         => $this->slplus->WPML->get_text( 'label_fax', $this->slplus->WPOption_Manager->get_wp_option( 'label_fax', __( 'Fax', 'slp-gravity-forms-locations' ) ), 'slp-gravity-forms-locations' ),
        );
        //-------------------------
        // GFL_Pemium ACTION: slp_gfl_settings_page
        //    params: settings object, section name
        //-------------------------
        $location_fields = apply_filters( 'slp_gfl_get_location_fields', $location_fields );
        $this->debugMP( 'pr', __FUNCTION__ . ' location_fields:', $location_fields );
        return $location_fields;
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