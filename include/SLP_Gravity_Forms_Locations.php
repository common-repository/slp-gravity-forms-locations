<?php

defined( 'ABSPATH' ) || exit;
require_once SLPLUS_PLUGINDIR . 'include/base_class.addon.php';
// Define some constants for use by this add-on
//	Our SLP_GFL_MAPPING post_type.
slp_gfl_maybe_define_constant( 'POST_TYPE_SLP_GFL_MAPPING', 'slp_gfl_mapping' );
//
//	Our SLP_GFL_ generic definitions.
slp_gfl_maybe_define_constant( 'SLP_GFL_MAPPING_ID_SLUG', 'slp_gfl_mapping_id' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SLUG_PREFIX', 'slp_gfl_' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_FORMS_ID_SLUG', 'slp_gfl_forms_id' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ENTRY_ID_SLUG', 'slp_gfl_entry_id' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_POST_ID_SLUG', 'slp_gfl_post_id' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_RESUME_TOKEN_SLUG', 'slp_gfl_resume_token' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_LOCATION_ID_SLUG', 'slp_gfl_location_id' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_LOCATION_NAME_SLUG', 'slp_gfl_location_name' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_OPERATOR_IS', '=' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_OPERATOR_IS_NOT', '!=' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_FORMS_ID_NONE', 'no_gf_form' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_DUPLICATES_HANDLING_ADD', 'add' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_DUPLICATES_HANDLING_SKIP', 'skip' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_DUPLICATES_HANDLING_UPDATE', 'update' );
//
//	Our SLP_GFL_Free specific definitions.
slp_gfl_maybe_define_constant( 'SLP_GFL_OPTION_NAME', 'slp-gravity-forms-locations-options' );
//
//	Gravity Forms minimum required version
slp_gfl_maybe_define_constant( 'SLP_GRAVITY_FORMS_MINIMUM_VERSION', '2.4' );
//
slp_gfl_maybe_define_constant( 'SLP_GRAVITY_FORMS_PLUGIN_NAME', 'Gravity Forms' );
//
slp_gfl_maybe_define_constant( 'SLP_GRAVITY_FORMS_DOWNLOAD_URL', 'https://www.gravityforms.com/' );
//
//	Some SLP_GFL_ specific definitions.
slp_gfl_maybe_define_constant( 'SLP_GFL_BUTTONS_KEY', 'gfi_buttons' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ALLOW_GFL_BUTTONS_ADMIN_ONLY', 'gfl_allow_admin_only' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ALLOW_GFL_BUTTONS_USER_CREATED', 'gfl_allow_created_by_only' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ALLOW_GFL_BUTTONS_USERS_ONLY', 'gfl_allow_slp_users_only' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ALLOW_GFL_BUTTONS_ALL_USERS', 'gfl_allow_all_users' );
//
//	Some SLP_GFL_ specific definitions.
slp_gfl_maybe_define_constant( 'SLP_GFL_FORM_ID_SELECTOR_HIDDEN', 'hidden' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_FORM_ID_SELECTOR_DROPDOWN', 'dropdown_discretefilter' );
//
//	Our SLP_GFL_FREE_ definitions.
slp_gfl_maybe_define_constant( 'SLP_GFL_FREE_SLUG', 'slp-gravity-forms-locations-free' );
//
//slp_gfl_maybe_define_constant( 'SLP_GFL_FREE_NAME',                  'SLP Gravity Forms Locations (Free)'       );  //
//slp_gfl_maybe_define_constant( 'SLP_GFL_FREE_MIN_VERSION',           '5.0.0'                                    );  //
//slp_gfl_maybe_define_constant( 'SLP_GFL_FREE_URL',                   'https://wordpress.org/plugins/store-locator-plus-gravity-forms-locations-free/' );  //
// Define some constants for use by this add-on
slp_gfl_maybe_define_constant( 'SLP_GFL_SETTINGS_SECTION', 'gfl_settings_section' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SETTINGS_GROUP_FREE', 'gfl_settings_group_free' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SETTINGS_GROUP_PREMIUM', 'gfl_settings_group_premium' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SETTINGS_GROUP_EXPLANATION', 'gfl_settings_group_explanation' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SETTINGS_GROUP_SAVE', 'gfl_settings_group_save' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SEARCH_GRAVITY_FORMS_GROUP', 'gravity_forms' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_SUPPORT_URL', 'https://www.de-baat.nl/' . SLP_GFL_SHORT_SLUG );
// The URL link to the documentation support page
slp_gfl_maybe_define_constant( 'SLP_GFL_ACTION', 'gfl_action' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ACTION_SAVE', 'gfl_action_save' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_ACTION_REQUEST', 'gfl_action_request' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_NOTICE_SUCCESS', '10' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_NOTICE_INFO', '6' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_NOTICE_WARNING', '1' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_NOTICE_ERROR', '1' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_CSL_SEPARATOR', '--' );
//
//	Our GFL_Tagalong_ definitions.
slp_gfl_maybe_define_constant( 'SLP_GFL_TAGALONG_FIELD', 'gfi_tagalong_field' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_TAGALONG_PREFIX', '+' );
//
slp_gfl_maybe_define_constant( 'SLP_GFL_TAGALONG_SEPARATOR', '|_|' );
//
// SLP_GFL Plugin Dir and Url
//
slp_gfl_maybe_define_constant( 'SLPLUS_PLUGINDIR_GFL', plugin_dir_path( SLP_GFL_FILE ) );
slp_gfl_maybe_define_constant( 'SLPLUS_PLUGINURL_GFL', plugins_url( '', SLP_GFL_FILE ) );
// Get the Gravity Forms specific actions and filters
// And include SLP_GFL specific functions
require_once 'slp-gfl-gravityforms.php';
/**
 * The Gravity Forms Locations add-on pack for Store Locator Plus.
 *
 * @package StoreLocatorPlus\SLP_Gravity_Forms_Locations
 * @author DeBAAT <slp-gfl@de-baat.nl>
 * @copyright 2022 De B.A.A.T. - Charleston Software Associates, LLC
 */
class SLP_Gravity_Forms_Locations extends SLP_BaseClass_Addon
{
    protected  $class_prefix = SLP_GFL_CLASS_PREFIX ;
    /**
     * Settable options for this plugin.
     *
     * @var mixed[] $options
     */
    public  $options = array(
        'installed_version'                    => SLP_GFL_NO_INSTALLED_VERSION,
        'gfl_skip_geocoding'                   => '0',
        'gfl_duplicates_handling'              => SLP_GFL_DUPLICATES_HANDLING_UPDATE,
        'gfl_form_id'                          => '',
        'gfl_form_id_selector'                 => 'hidden',
        'label_for_gfl_form_id_selector'       => '',
        'search_by_gfl_form_id_pd_label'       => '',
        'search_for_none_gfl_form_id_pd_label' => '',
        'gfl_show_gfl_buttons'                 => '1',
        'gfl_allow_gfl_buttons'                => 'gfl_allow_admin_only',
    ) ;
    public  $admin ;
    public static  $instance ;
    public  $remote_version = '' ;
    public  $gfl_tagalong ;
    public  $is_slp_power_active = false ;
    public  $is_slp_pages_active = false ;
    public  $is_slp_pages_needed = false ;
    private  $slp_power ;
    private  $slp_pages ;
    /**
     * Invoke the plugin.
     *
     * This ensures a singleton of this plugin.
     *
     * @static
     */
    public static function init()
    {
        static  $instance = false ;
        
        if ( !$instance ) {
            load_plugin_textdomain( 'slp-gravity-forms-locations', false, SLP_GFL_REL_DIR . '/languages/' );
            $instance = new SLP_Gravity_Forms_Locations( array(
                'version'                  => SLP_GFL_VERSION,
                'min_slp_version'          => SLP_GFL_MIN_SLP,
                'name'                     => __( 'Gravity Forms Locations', 'slp-gravity-forms-locations' ),
                'option_name'              => SLP_GFL_OPTION_NAME,
                'file'                     => SLP_GFL_FILE,
                'admin_class_name'         => 'SLP_Gravity_Forms_Locations_Admin',
                'activation_class_name'    => 'SLP_Gravity_Forms_Locations_Activation',
                'ajax_class_name'          => 'SLP_Gravity_Forms_Locations_AJAX',
                'userinterface_class_name' => 'SLP_Gravity_Forms_Locations_UI',
            ) );
        }
        
        // Validate this version of GFL, priority should assure late validation
        add_action( 'slp_init_complete', array( $instance, 'slp_gfl_VersionCheck' ), 98 );
        // Initialize GFL specifics
        add_action( 'slp_init_complete', array( $instance, 'slp_init_complete_gfl' ), 88 );
        return $instance;
    }
    
    /**
     * Initialize the options properties from the WordPress database.
     */
    function init_options()
    {
        parent::init_options();
    }
    
    /**
     * Run these things during invocation. (called from base object in __construct)
     */
    protected function initialize()
    {
        $this->slplus->min_add_on_versions[SLP_GFL_SHORT_SLUG] = SLP_GFL_VERSION;
        parent::initialize();
    }
    
    /**
     * Initialize some GFL variables
     */
    function slp_init_complete_gfl()
    {
        // Setup for GFL specific items
        $this->register_cpt_slp_gfl_mapping();
    }
    
    /**
     * Add cross-element hooks & filters.
     *
     * Haven't yet moved all items to the AJAX and UI classes.
     */
    function add_hooks_and_filters()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
    }
    
    /**
     * Check whether the current version of this Add On works with the latest version of the SLP base plugin.
     * This is already checked against the SLP_ELM_MIN_SLP version in the loader
     *
     * @return boolean
     */
    private function check_my_version_compatibility()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' started but not needed for version=' . $this->version );
        return true;
    }
    
    /**
     * Get the latest version of this Add On from Freemius.
     *
     * @return string
     */
    function get_latest_version_from_freemius()
    {
        // Get the Freemius object for this plugin
        $fs = slp_gfl_freemius_get_freemius();
        //$this->debugMP('pr', __FUNCTION__ . ' found fs=', $fs );
        // Get the _storage object of this FS Freemius object
        $_slug = $fs->get_slug();
        $_module_type = $fs->get_module_type();
        $_storage = FS_Storage::instance( $_module_type, $_slug );
        // $this->debugMP('pr', __FUNCTION__ . ' found _storage=', $_storage );
        $this->remote_version = $_storage->plugin_last_version;
        $this->debugMP( 'msg', __FUNCTION__ . ' found remote_version=' . $this->remote_version . ' for _module_type=' . $_module_type . ' and _slug=' . $_slug );
        return $this->remote_version;
    }
    
    /**
     * Creates updates object AND checks for updates for this add-on.
     * Not needed as this is handled by Freemius
     *
     * @param boolean $force
     */
    function create_object_Updates( $force )
    {
        $latest_version = $this->get_latest_version_from_freemius();
        $this->debugMP( 'msg', __FUNCTION__ . ' found version=' . $this->version . ' and latest_version=' . $latest_version );
    }
    
    /**
     * Compare current plugin version with minimum required.
     *
     * Set a notification message.
     * Disable this add-on pack if requirement is not met.
     */
    function slp_gfl_VersionCheck()
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' Validate for ' . $this->name );
        $slp_validated_ok = true;
        // Validate availability of Gravity Forms
        
        if ( !slp_gfl_is_gravityforms_supported() ) {
            $slp_validated_ok = false;
            if ( is_admin() ) {
                if ( isset( $this->slplus->notifications ) ) {
                    $this->slplus->notifications->add_notice( 4, '<strong>' . sprintf( __( 'SLP %s has been deactivated.', 'slp-gravity-forms-locations' ), $this->name ) . '<br/> ' . '</strong>' . sprintf( __( 'This plugin requires %s to be installed and active.', 'slp-gravity-forms-locations' ), SLP_GRAVITY_FORMS_PLUGIN_NAME ) . '<br/> ' . sprintf(
                        __( 'Please <a href="%s">download</a> at least version %s of %s and try again.', 'slp-gravity-forms-locations' ),
                        SLP_GRAVITY_FORMS_DOWNLOAD_URL,
                        SLP_GRAVITY_FORMS_MINIMUM_VERSION,
                        SLP_GRAVITY_FORMS_PLUGIN_NAME
                    ) . '<br/>' );
                }
            }
        }
        
        // Act on validation result
        
        if ( !$slp_validated_ok ) {
            $this->debugMP( 'msg', __FUNCTION__ . ' ' . $this->name . ' VALIDATED FALSE so deactivate_plugins [' . $this->slug . ']!' );
            deactivate_plugins( $this->slug );
        }
        
        return $slp_validated_ok;
    }
    
    /**
     * Add the tabs/main menu items.
     *
     * @param mixed[] $menuItems
     * @return mixed[]
     */
    public function filter_AddMenuItems( $menuItems )
    {
        $this->debugMP( 'msg', __FUNCTION__ );
        $this->createobject_Admin();
        $this->admin_menu_entries = array();
        $this->admin_menu_entries[] = array(
            'label'    => __( 'Gravity Forms', 'slp-gravity-forms-locations' ),
            'slug'     => SLP_GFL_ADMIN_PAGE_SLUG,
            'class'    => $this->admin->gfl_admin_settings,
            'function' => 'render_gfl_admin_settings',
        );
        return parent::filter_AddMenuItems( $menuItems );
    }
    
    //-------------------------------------
    // Methods : Custom Post Type slp_gfl_mapping
    //-------------------------------------
    /**
     * Create the Custom Post Type slp_gfl_mapping
     *
     */
    function register_cpt_slp_gfl_mapping()
    {
        $this->debugMP( 'msg', __FUNCTION__ );
        $labels = array(
            'name'               => __( 'GFL Mappings', 'slp-gravity-forms-locations' ),
            'singular_name'      => __( 'GFL Mapping', 'slp-gravity-forms-locations' ),
            'add_new'            => __( 'Add New', 'slp-gravity-forms-locations' ),
            'add_new_item'       => __( 'Add New GFL Mapping', 'slp-gravity-forms-locations' ),
            'edit_item'          => __( 'Edit GFL Mapping', 'slp-gravity-forms-locations' ),
            'new_item'           => __( 'New GFL Mapping', 'slp-gravity-forms-locations' ),
            'view_item'          => __( 'View GFL Mapping', 'slp-gravity-forms-locations' ),
            'search_items'       => __( 'Search GFL Mappings', 'slp-gravity-forms-locations' ),
            'not_found'          => __( 'No gfl mappings found', 'slp-gravity-forms-locations' ),
            'not_found_in_trash' => __( 'No gfl mappings found in Trash', 'slp-gravity-forms-locations' ),
            'parent_item_colon'  => __( 'Parent GFL Mapping:', 'slp-gravity-forms-locations' ),
            'menu_name'          => __( 'GFL Mappings', 'slp-gravity-forms-locations' ),
        );
        $args = array(
            'labels'              => $labels,
            'hierarchical'        => false,
            'description'         => __( 'This post_type contains the mappings for GF to SLP.', 'slp-gravity-forms-locations' ),
            'supports'            => array( 'title' ),
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => 'admin.php?page=gf_edit_forms',
            'menu_position'       => 80,
            'show_in_nav_menus'   => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => true,
            'capability_type'     => 'post',
        );
        register_post_type( POST_TYPE_SLP_GFL_MAPPING, $args );
        // Filters for Custom Post Type slp_gfl_mapping support
        add_filter( 'manage_edit-slp_gfl_mapping_columns', array( $this, 'slp_gfl_mapping_edit_columns' ) );
        add_action(
            'manage_slp_gfl_mapping_posts_custom_column',
            array( $this, 'slp_gfl_mapping_custom_columns' ),
            10,
            2
        );
        add_action( 'add_meta_boxes', array( $this, 'slp_gfl_mapping_add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'slp_gfl_mapping_save_post' ) );
        // Remove unwanted meta_boxes
        $this->slp_gfl_mapping_remove_meta_box();
    }
    
    public function slp_gfl_mapping_edit_columns( $columns )
    {
        $columns = array(
            'cb'                      => '<input type="checkbox" />',
            'title'                   => __( 'Title', 'slp-gravity-forms-locations' ),
            'slp_gfl_mapping_form'    => __( 'Form Title', 'slp-gravity-forms-locations' ),
            'slp_gfl_mapping_form_id' => __( 'Form ID', 'slp-gravity-forms-locations' ),
            'date'                    => __( 'Date', 'slp-gravity-forms-locations' ),
        );
        return $columns;
    }
    
    public function slp_gfl_mapping_custom_columns( $column, $post_id )
    {
        global  $post ;
        $this->debugMP( 'msg', __FUNCTION__ . ' post_id = ' . $post_id . ', column = ' . $column );
        switch ( $column ) {
            case 'slp_gfl_mapping_form':
            case 'slp_gfl_mapping_form_id':
                $form_id = get_post_meta( $post_id, '_slp_gfl_mapping_form_id', true );
                
                if ( $column == 'slp_gfl_mapping_form' ) {
                    $value = get_slp_gfl_mapping_form_title( $form_id );
                } else {
                    $value = $form_id;
                }
                
                
                if ( !empty($form_id) ) {
                    printf( '<a href="%s">%s</a>', add_query_arg( array(
                        'page' => 'gf_edit_forms',
                        'id'   => $form_id,
                    ), admin_url( 'admin.php' ) ), $value );
                } else {
                    echo  '—' ;
                }
                
                break;
        }
    }
    
    /**
     * Add meta boxes
     */
    public function slp_gfl_mapping_add_meta_boxes()
    {
        add_meta_box(
            POST_TYPE_SLP_GFL_MAPPING,
            __( 'Configuration', 'slp-gravity-forms-locations' ),
            array( $this, 'meta_box_config' ),
            POST_TYPE_SLP_GFL_MAPPING,
            'normal',
            'high'
        );
        // Remove unwanted meta_boxes
        $this->slp_gfl_mapping_remove_meta_box();
    }
    
    /**
     * Remove unwanted meta boxes
     */
    public function slp_gfl_mapping_remove_meta_box()
    {
        global  $wp_meta_boxes ;
        
        if ( !isset( $wp_meta_boxes ) ) {
            $this->debugMP( 'msg', __FUNCTION__ . ' wp_meta_boxes NOT set!' );
            return;
        }
        
        // Process all wp_meta_boxes registered for POST_TYPE_SLP_GFL_MAPPING
        $debug_wp_meta_boxes = array();
        foreach ( $wp_meta_boxes as $key_page => $wp_meta_boxes_page ) {
            $debug_wp_meta_boxes[$key_page] = array();
            foreach ( $wp_meta_boxes_page as $key_context => $wp_meta_boxes_context ) {
                $debug_wp_meta_boxes[$key_page][$key_context] = array();
                foreach ( $wp_meta_boxes_context as $key_priority => $wp_meta_boxes_priority ) {
                    $debug_wp_meta_boxes[$key_page][$key_context][$key_priority] = array();
                    foreach ( $wp_meta_boxes_priority as $key_id => $wp_meta_boxes_id ) {
                        $debug_wp_meta_boxes[$key_page][$key_context][$key_priority][$key_id] = $key_id;
                        // Only remove_meta_box not defined for this POST_TYPE_SLP_GFL_MAPPING
                        
                        if ( $key_page == POST_TYPE_SLP_GFL_MAPPING && $key_id !== POST_TYPE_SLP_GFL_MAPPING && $key_priority !== 'core' ) {
                            $this->debugMP( 'msg', __FUNCTION__ . ' remove_meta_box for ' . $key_id );
                            remove_meta_box( $key_id, POST_TYPE_SLP_GFL_MAPPING, $key_context );
                        }
                    
                    }
                }
            }
        }
        $this->debugMP( 'pr', __FUNCTION__ . ' debug_wp_meta_boxes = ', $debug_wp_meta_boxes );
    }
    
    /**
     * SLP_GFL_Mapping config meta box
     *
     * @param WP_Post $post The object for the current post/page.
     */
    public function meta_box_config( $post )
    {
        // Get the LocationsFields to process in slp-gfl-meta-box-config.php
        $LocationsFields = $this->admin->get_location_fields();
        $this->debugMP( 'pr', __FUNCTION__ . ' LocationsFields = ', $LocationsFields );
        include $this->addon->dir . 'include/slp-gfl-meta-box-config.php';
        $this->debugMP( 'pr', __FUNCTION__ . ' included = ', $this->addon->dir . 'include/slp-gfl-meta-box-config.php' );
    }
    
    /**
     * When the post is saved, saves our custom data.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function slp_gfl_mapping_save_post( $post_id )
    {
        $this->debugMP( 'msg', __FUNCTION__ . ' post_id = ' . $post_id );
        // Check if our nonce is set.
        if ( !filter_has_var( INPUT_POST, 'slp_gfl_nonce' ) ) {
            return $post_id;
        }
        $nonce = filter_input( INPUT_POST, 'slp_gfl_nonce', FILTER_SANITIZE_STRING );
        // Verify that the nonce is valid.
        if ( !wp_verify_nonce( $nonce, 'slp_gfl_mapping_save' ) ) {
            return $post_id;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // Check the user's permissions.
        
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        
        /* OK, its safe for us to save the data now. */
        $definition = array(
            '_slp_gfl_mapping_form_id'            => 'sanitize_text_field',
            '_slp_gfl_mapping_condition_enabled'  => FILTER_VALIDATE_BOOLEAN,
            '_slp_gfl_mapping_condition_field_id' => 'sanitize_text_field',
            '_slp_gfl_mapping_condition_operator' => 'sanitize_text_field',
            '_slp_gfl_mapping_condition_value'    => 'sanitize_text_field',
            '_slp_gfl_mapping_fields'             => array(
            'filter' => FILTER_SANITIZE_STRING,
            'flags'  => FILTER_REQUIRE_ARRAY,
        ),
        );
        foreach ( $definition as $meta_key => $function ) {
            $meta_value = null;
            
            if ( 'sanitize_text_field' == $function ) {
                if ( isset( $_POST[$meta_key] ) ) {
                    $meta_value = sanitize_text_field( $_POST[$meta_key] );
                }
            } else {
                $filter = $function;
                $options = null;
                
                if ( is_array( $function ) && isset( $function['filter'] ) ) {
                    $filter = $function['filter'];
                    $options = $function;
                }
                
                $meta_value = filter_input(
                    INPUT_POST,
                    $meta_key,
                    $filter,
                    $options
                );
            }
            
            
            if ( isset( $meta_value ) && '' != $meta_value ) {
                update_post_meta( $post_id, $meta_key, $meta_value );
            } else {
                delete_post_meta( $post_id, $meta_key );
            }
        
        }
        return $post_id;
    }
    
    /**
     * Create the country pulldown list, mark the checked item.
     *
     * @return string
     */
    public function createstring_GFLFormIDDropDownOptions()
    {
        $myOptions = '';
        $myGFLForms = GFAPI::get_forms();
        //$this->debugMP('pr',__FUNCTION__ . ' myGFLForms=', $myGFLForms);
        // Process the forms into a list for selection
        foreach ( $myGFLForms as $GFLForm ) {
            if ( $GFLForm['is_active'] ) {
                $myOptions .= "<option value='{$GFLForm['id']}'>{$GFLForm['title']} (id={$GFLForm['id']})</option>";
            }
        }
        return $myOptions;
    }
    
    /**
     * Check whether this user is allowed to edit this location form
     * 
     * @param   id       $entry_id     The entry_id to validate.
     *
     * @return boolean
     *
     */
    public function gfl_check_user_allowed( $entry_id )
    {
        // User must at least be logged in
        if ( !is_user_logged_in() ) {
            return false;
        }
        // Admin User is always allowed
        if ( current_user_can( 'manage_options' ) ) {
            return true;
        }
        // Check different options for gfl_allow_gfl_buttons
        switch ( $this->addon->options['gfl_allow_gfl_buttons'] ) {
            // Check whether only admin are allowed
            case SLP_GFL_ALLOW_GFL_BUTTONS_ADMIN_ONLY:
                return current_user_can( 'manage_options' );
                break;
                // Check whether all user_logged_in are allowed
            // Check whether all user_logged_in are allowed
            case SLP_GFL_ALLOW_GFL_BUTTONS_ALL_USERS:
                return is_user_logged_in();
                break;
                // Check manage_slp_user capability
            // Check manage_slp_user capability
            case SLP_GFL_ALLOW_GFL_BUTTONS_USERS_ONLY:
                return current_user_can( 'manage_slp_user' );
                break;
                // Check whether user created this form
            // Check whether user created this form
            case SLP_GFL_ALLOW_GFL_BUTTONS_USER_CREATED:
                $user_id = get_current_user_id();
                $gf_entry = GFAPI::get_entry( $entry_id );
                if ( is_wp_error( $gf_entry ) ) {
                    return false;
                }
                if ( $gf_entry['created_by'] != $user_id ) {
                    return false;
                }
                // All tests passed so user is ok
                return true;
                break;
                // No valid option
            // No valid option
            default:
                return false;
                break;
        }
        return false;
    }
    
    /**
     * Create a Map Settings Debug My Plugin panel.
     *
     * @return null
     */
    static function create_DMPPanels()
    {
        if ( !isset( $GLOBALS['DebugMyPlugin'] ) ) {
            return;
        }
        if ( class_exists( 'DMPPanelSLPGFL' ) == false ) {
            require_once 'class.dmppanels.php';
        }
        $GLOBALS['DebugMyPlugin']->panels['slp.gfl'] = new DMPPanelSLPGFL();
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