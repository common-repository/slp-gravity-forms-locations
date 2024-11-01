<?php
defined( 'ABSPATH'     ) || exit;

/**
 * Admin Settings for SLP_Gravity_Forms_Locations
 *
 * @property        SLP_Gravity_Forms_Locations                  $addon
 * @property        SLP_Gravity_Forms_Locations_Admin            $admin                              The admin object for this addon.
 * @property-read   SLP_Settings                                 $settings
 *
 */
class SLP_Gravity_Forms_Locations_Admin_Settings extends SLPlus_BaseClass_Object {

    public  $addon;
    public  $admin;
    public  $settings;

    /**
     * Things we do at the start.
     */
    function initialize( ) {

		$this->addon = SLP_Gravity_Forms_Locations_Get_Instance();
		$this->debugMP('msg', __FUNCTION__ . ' started.');

        $this->settings = new SLP_Settings(array(
            'name'              => SLPLUS_NAME . __(' - Gravity Forms Locations','slp-gravity-forms-locations'),
            'form_action'       => '',
            'save_text'         => __('Save Settings', 'slp-gravity-forms-locations'),
            ));

	}

    /**
     * Add the standard NavBar to the SLP_Gravity_Forms_Locations page.
     */
    function add_NavBarToTab() {
		$this->debugMP('msg', __FUNCTION__ . ' started.');
        $this->settings->add_section(
            array(
                'name'          => 'Navigation',
                'div_id'        => 'navbar_wrapper',
                'description'   => SLP_Admin_UI::get_instance()->create_Navbar(),
                'innerdiv'      => false,
                'is_topmenu'    => true,
                'auto'          => false,
            )
        );
    }


    /**
     * Add the SLP_Gravity_Forms_Locations General Settings Section.
     */
    private function add_gravity_forms_locations_SettingsSection() {

		$this->debugMP('pr', __FUNCTION__ . ' started with options:', $this->addon->options);

        $this->settings->add_section(
            array(
				'slug'          => SLP_GFL_SETTINGS_SECTION,
				'group'         => SLP_GFL_SETTINGS_GROUP_FREE,
				'innerdiv'      => true,
				'auto'          => true,
				'first'         => true,
            )
        );

		// Create the group for free options
		$this->settings->add_group( array(
				'section_slug' => SLP_GFL_SETTINGS_SECTION,
				'group_slug'   => SLP_GFL_SETTINGS_GROUP_FREE,
				'plugin'       => $this->addon,
			)
		);

		// Create the group for premium options
		$this->settings->add_group( array(
				'section_slug' => SLP_GFL_SETTINGS_SECTION,
				'group_slug'   => SLP_GFL_SETTINGS_GROUP_PREMIUM,
				'plugin'       => $this->addon,
			)
		);

		// Create the group for explanation options
		$this->settings->add_group( array(
				'section_slug' => SLP_GFL_SETTINGS_SECTION,
				'group_slug'   => SLP_GFL_SETTINGS_GROUP_EXPLANATION,
				'plugin'       => $this->addon,
				'header'       => __('Explanation', 'slp-gravity-forms-locations'),
			)
		);
		$this->add_gravity_forms_locations_settings_explanation();
    }


	/**
	 * Add Premium Subscription section to settings page.
	 */
	function add_gravity_forms_locations_settings_explanation() {

		// Explanation : GFL Mappings Custom Post Types
		$post_type_url = admin_url('edit.php?post_type=' . POST_TYPE_SLP_GFL_MAPPING);
		$this->settings->add_ItemToGroup( array(
			'section_slug' => SLP_GFL_SETTINGS_SECTION,
			'group_slug'   => SLP_GFL_SETTINGS_GROUP_EXPLANATION,
			'plugin'       => $this->addon,
			'header'       => __('Explanation', 'slp-gravity-forms-locations'),
			'label'        => __('GFL Mappings', 'slp-gravity-forms-locations'),
			'type'         => 'subheader',
			'show_label'   => false,
			'description'  =>
				sprintf(__('Manage the <a href="%s">%s</a> post type entries.','slp-gravity-forms-locations'), $post_type_url, POST_TYPE_SLP_GFL_MAPPING)
		) );

		// Explanation : Documentation
		$this->settings->add_ItemToGroup( array(
			'section_slug' => SLP_GFL_SETTINGS_SECTION,
			'group_slug'   => SLP_GFL_SETTINGS_GROUP_EXPLANATION,
			'plugin'       => $this->addon,
			'label'        => __('Documentation', 'slp-gravity-forms-locations'),
			'type'         => 'subheader',
			'show_label'   => false,
			'description'  =>
				sprintf(__('View the <a href="%s" target="csa">documentation</a> for more info.','slp-gravity-forms-locations'), SLP_GFL_SUPPORT_URL)
		) );
	}


	/**
	 * Add the menu to show different sections.
	 */
	function render_group_section_menu( $menu_name = '', $menu_page = '' ) {

		$menu_selected = false;
		if (isset($_REQUEST['page'])) {
			$menu_selected = $menu_page == $_REQUEST['page'];
		} else {
			$menu_selected = $menu_page == SLP_GFL_ADMIN_PAGE_SLUG;
		}
		$firstClass    = $menu_selected ? ' first current open' : '';
		$menu_link     = admin_url() . 'admin.php?page=' . $menu_page;

		$return_html   = "";
		$return_html  .= "<li class='top-level general {$firstClass} navbar-item'>";
		$return_html  .= "<a id='" . $menu_page . "_sidemenu' class='navbar-link subtab_link' ";
		$return_html  .= "data-slug='" . $menu_page . "' ";
		$return_html  .= "href='" . $menu_link . "' ";
		$return_html  .= "title='" . $menu_name . "' ";
		$return_html  .= ">";
		$return_html  .= $menu_name;
		$return_html  .= "</a>";
		$return_html  .= "</li>";

		return $return_html;
	}



	/**
	 * Search / Appearance
	 */
	private function add_search_gravity_forms() {

		$slug = 'search';
		$group_params = array();

		$group_params[ 'plugin'       ] = $this->slplus;
		$group_params[ 'section_slug' ] = $slug;
		$group_params[ 'group_slug'   ] = SLP_GFL_SEARCH_GRAVITY_FORMS_GROUP;
		$this->settings->add_group( $group_params );
	}

    /**
     * Build the reports tab content.
     */
    function render_gfl_admin_settings( ) {
		$this->debugMP('msg', __FUNCTION__ . ' started.' );
		$this->debugMP('pr', __FUNCTION__ . ' started with _GET =', $_GET );
		$this->debugMP('pr', __FUNCTION__ . ' started with _POST =', $_POST );
		$this->debugMP('pr', __FUNCTION__ . ' started with _REQUEST =', $_REQUEST );
		$this->debugMP('pr', __FUNCTION__ . ' started with slplus->clean =', $this->slplus->clean );

		// Save the settings that changed
        $this->save_Settings();
        $this->add_NavBarToTab();

		// Show Notices
		$this->slplus->notifications->display();

		// Add the General Settings section
		if ( $this->check_slp_gravity_forms_locations_page( SLP_GFL_ADMIN_PAGE_SLUG ) ) {
			$this->add_gravity_forms_locations_SettingsSection();
		}

		// Add the General Settings section
		if ( $this->check_slp_gravity_forms_locations_page( 'slp_experience' ) ) {
			$this->add_search_gravity_forms();
		}

        $this->settings->render_settings_page();
    }

    /**
     * Handle the slp_gfl_action_request.
     */
    function check_slp_gravity_forms_locations_page( $slp_gfl_page_to_check = false ) {

		if ( $slp_gfl_page_to_check === false ) {
			return false;
		}
		if ( isset($_REQUEST['page']) && ( $_REQUEST['page'] == $slp_gfl_page_to_check ) ) {
			return true;
		}
		return false;
    }

    /**
     * Handle the slp_gfl_action_request.
     */
    function handle_slp_gfl_action_request( $slp_gfl_action_request = '' ) {

		$this->debugMP('msg', __FUNCTION__ . ' started with slp_gfl_action_request = ' . $slp_gfl_action_request );

		switch ( $slp_gfl_action_request ) {

			case SLP_GFL_ACTION_SAVE:
				$this->save_gravity_forms_locations_Settings();
				break;

			default:
				break;
		}

    }

    /**
     * Save settings when appropriate.
     */
    function save_gravity_forms_locations_Settings() {

		$this->debugMP('msg', __FUNCTION__ . ' started.');

		$this->debugMP('pr',__FUNCTION__ . ' ---> this->addon->options[' . $this->addon->option_name . '] = ', $this->addon->options);
		$this->debugMP('pr',__FUNCTION__ . ' ---> this->settings->current_admin_page = ', $this->settings->current_admin_page);
		$this->debugMP('pr',__FUNCTION__ . ' ---> this->SmartOptions->smart_properties = ', $this->slplus->SmartOptions->smart_properties);
		$this->debugMP('pr',__FUNCTION__ . ' ---> this->SmartOptions->current_checkboxes = ', $this->slplus->SmartOptions->current_checkboxes);

		$this->slplus->SmartOptions->set_checkboxes( 'slp_gravity_forms_locations_settings' );

		array_walk( $_REQUEST, array( $this->slplus->SmartOptions, 'set_valid_options' ) );

		$this->slplus->WPOption_Manager->update_wp_option( $this->addon->option_name , $this->addon->options );

		// Serialized Options Setting for stuff NOT going to slp.js.
		// This should be used for ALL new options not going to slp.js.
		//
		array_walk( $_REQUEST, array( $this->slplus, 'set_ValidOptionsNoJS' ) );
		if ( isset( $_REQUEST['options_nojs'] ) ) {
			array_walk( $_REQUEST['options_nojs'], array( $this->slplus, 'set_ValidOptionsNoJS' ) );
		}

	    SLP_SmartOptions::get_instance()->save();
        $this->slplus->WPOption_Manager->update_wp_option( $this->addon->option_name , $this->addon->options );
		$this->slplus->SmartOptions->execute_change_callbacks();       // Anything changed?  Execute their callbacks.
    }

    /**
     * Save settings when appropriate.
     */
    function save_Settings() {

		$this->debugMP('msg', __FUNCTION__ . ' started.');

		// Check whether there is an action to perform
	    if ( !empty( $_REQUEST[ SLP_GFL_ACTION_REQUEST ] ) ) {
			$this->handle_slp_gfl_action_request( $_REQUEST[ SLP_GFL_ACTION_REQUEST ] );
			$this->debugMP('msg', __FUNCTION__ . ' returned because _REQUEST[ ' . SLP_GFL_ACTION_REQUEST . ' ] = ' . esc_html($_REQUEST[ SLP_GFL_ACTION_REQUEST ] ));
	    	return;
	    }

		// Check whether there is an action to perform
	    if ( !empty( $_REQUEST[ SLP_GFL_ACTION_SAVE ] ) ) {
			$this->handle_slp_gfl_action_request( $_REQUEST[ SLP_GFL_ACTION_SAVE ] );
			$this->debugMP('msg', __FUNCTION__ . ' returned because _REQUEST[ ' . SLP_GFL_ACTION_SAVE . ' ] = ' . esc_html($_REQUEST[ SLP_GFL_ACTION_SAVE ] ));
	    	return;
	    }

	    if ( empty( $_REQUEST['action'] ) ) {
			$this->debugMP('msg', __FUNCTION__ . ' returned because _REQUEST[action] = empty.');
	    	return;
	    }
	    if ( $_REQUEST['action'] !== 'update' ) {
			$this->debugMP('msg', __FUNCTION__ . ' returned because _REQUEST[action] != update.');
//	    	return;
	    }
	    if ( empty( $_REQUEST['_wp_http_referer'] ) ) {
			$this->debugMP('msg', __FUNCTION__ . ' returned because _REQUEST[_wp_http_referer] = empty.');
	    	return;
	    }
        if ( substr( $_REQUEST['_wp_http_referer'] , -strlen('page=' . SLP_GFL_ADMIN_PAGE_SLUG) ) !== 'page=' . SLP_GFL_ADMIN_PAGE_SLUG ) {
			$this->debugMP('msg', __FUNCTION__ . ' returned because _REQUEST[_wp_http_referer] != ' . SLP_GFL_ADMIN_PAGE_SLUG . '.');
            return;
        }


		// handle the actual save_Settings
		$this->save_gravity_forms_locations_Settings();

    }

	/**
	 * Simplify the parent debugMP interface.
	 *
	 * @param string $type
	 * @param string $hdr
	 * @param string $msg
	 */
	function debugMP($type,$hdr,$msg='') {
		if (($type === 'msg') && ($msg!=='')) {
			$msg = esc_html($msg);
		}
		$hdr = __CLASS__ . ':: ' . $hdr;

		SLP_Gravity_Forms_Locations_debugMP($type,$hdr,$msg,NULL,NULL,true);
	}

}
