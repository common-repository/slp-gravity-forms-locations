<?php
if (! class_exists('SLP_Gravity_Forms_Locations_Activation')) {
	require_once(SLPLUS_PLUGINDIR.'/include/base_class.activation.php');

    /**
     * Manage plugin activation.
     *
	 * @property    SLP_Gravity_Forms_Locations            $addon
     */
	class SLP_Gravity_Forms_Locations_Activation extends SLP_BaseClass_Activation {

		public    $addon;

		protected $smart_options = array(

			// General Options
			'installed_version'                    => '',

			// Gravity Forms Locations Options
			'gfl_skip_geocoding'                   => 'off',
			'gfl_duplicates_handling'              => 'update',

			// Gravity Forms Integration Options
            'gfl_form_id'                          => '',
            'gfl_form_id_selector'                 => 'hidden',
            'label_for_gfl_form_id_selector'       => '',
			'search_by_gfl_form_id_pd_label'       => '',
			'search_for_none_gfl_form_id_pd_label' => '',
			'gfl_show_gfl_buttons'                 => '1',
			'gfl_allow_gfl_buttons'                => 'gfl_allow_admin_only',
		);

		/**
		 * Settable options for the old addons
		 *
		 * @var mixed[] $options
		 */
		public $gfl_option_name_before  = 'slplus-gfl-free-options';
		public $gfi_option_name_before  = 'slplus-gravity-forms-integration-options';
		public $gfl_options_before      = array();
		public $gfi_options_before      = array();

		/**
		 * Update or create the data tables.
		 *
		 * This can be run as a static function or as a class method.
		 */
		function update() {
			$this->debugMP('msg', __FUNCTION__ . ' started with this->addon->version ' . $this->addon->version . '!');

			$this->updating_from = isset( $this->addon->options['installed_version'] ) ? $this->addon->options['installed_version'] : SLP_GFL_NO_INSTALLED_VERSION;
			$this->debugMP('msg', __FUNCTION__ . ' started with updating_from ' . $this->updating_from . '!!!');

			if ( version_compare( $this->updating_from, $this->addon->version, '=' ) ) {
				$this->debugMP('msg', __FUNCTION__ . ' returned because updating_from ' . $this->updating_from . ' == addon->version ' . $this->addon->version);
				return;
			}
			$this->debugMP('pr', __FUNCTION__ . ' found addon->options[' . $this->addon->option_name . ']: ', $this->addon->options);
			$this->debugMP('msg', __FUNCTION__ . ' TODO migrate options to the right place for updating_from ' . $this->updating_from . '!!!');

			// Set debug settings
			//$this->set_debug_legacy_options_gfl( false );
			//$this->set_debug_legacy_options_gfi( false );

			// Migrate old option settings to this addon
			$this->migrate_legacy_options_gfl();
			$this->migrate_legacy_options_gfi();

			parent::update();

			// Update the options in addon->options.
			$this->debugMP('pr', __FUNCTION__ . ' UPDATES addon->options[' . $this->addon->option_name . ']: ', $this->addon->options);
			$this->addon->options['installed_version'] = $this->addon->version;
			update_option( $this->addon->option_name, $this->addon->options );

			// Update the options in SmartOptions.
			SLP_SmartOptions::get_instance()->save();
			$this->slplus->WPOption_Manager->update_wp_option( $this->addon->option_name , $this->addon->options );
			$this->slplus->WPOption_Manager->update_wp_option( 'js' );
			$this->slplus->WPOption_Manager->update_wp_option( 'nojs' );
			$this->slplus->SmartOptions->execute_change_callbacks();       // Anything changed?  Execute their callbacks.

			// Add (or update) the Extended Data fields for Gravity Forms Locations addon
			$this->slplus->database->extension->add_field( __( 'GF Entry ID'      ,'slp-gravity-forms-locations' ), 'varchar', array( 'slug' => SLP_GFL_ENTRY_ID_SLUG,     'addon' => $this->addon->short_slug ), 'wait' );
			$this->slplus->database->extension->add_field( __( 'GF Forms ID'      ,'slp-gravity-forms-locations' ), 'varchar', array( 'slug' => SLP_GFL_FORMS_ID_SLUG,     'addon' => $this->addon->short_slug ), 'wait' );
			$this->slplus->database->extension->add_field( __( 'GF Mapping ID'    ,'slp-gravity-forms-locations' ), 'varchar', array( 'slug' => SLP_GFL_MAPPING_ID_SLUG,   'addon' => $this->addon->short_slug ), 'wait' );
			$this->slplus->database->extension->add_field( __( 'GF Post ID'       ,'slp-gravity-forms-locations' ), 'varchar', array( 'slug' => SLP_GFL_POST_ID_SLUG,      'addon' => $this->addon->short_slug ), 'wait' );
			$this->slplus->database->extension->add_field( __( 'GF Resume Token'  ,'slp-gravity-forms-locations' ), 'varchar', array( 'slug' => SLP_GFL_RESUME_TOKEN_SLUG, 'addon' => $this->addon->short_slug ), 'wait' );
            $this->slplus->database->extension->update_data_table( array('mode'=>'force') );

			$this->addon->options['installed_version'] =  $this->addon->version ;  // made persistent via addon admin_init call

		}

		/**
		 * Migrate the options of the old Gravity Forms Locations Free addon.
		 */
		private function migrate_legacy_options_gfl() {
			$this->debugMP('msg', __FUNCTION__ . ' started.');

			$this->gfl_options_before = get_option( $this->gfl_option_name_before );
			$this->debugMP('pr', __FUNCTION__ . ' found options_before[' . $this->gfl_option_name_before . ']: ', $this->gfl_options_before);
			$this->debugMP('pr', __FUNCTION__ . ' found addon->options[' . $this->addon->option_name . ']: ', $this->addon->options);

			// Return when there are no options to migrate
			if ( $this->gfl_options_before === false ) {
				return;
			}

			// Migrate the options found
			$installed_version_before = $this->gfl_options_before[ 'installed_version' ];

			// Only update if not processed yet
			if ( version_compare( $installed_version_before , '99.99' , '<=' ) ) {
				// Migrate original options_before to the addon->options
				$this->addon->options[ 'gfl_skip_geocoding'           ] = $this->gfl_options_before[ 'gfl_skip_geocoding'           ];
				$this->addon->options[ 'gfl_duplicates_handling'      ] = $this->gfl_options_before[ 'gfl_duplicates_handling'      ];

				// Migrate original options_before to the SmartOptions
				$this->slplus->SmartOptions->set( 'gfl_skip_geocoding' ,      $this->gfl_options_before[ 'gfl_skip_geocoding'           ] );
				$this->slplus->SmartOptions->set( 'gfl_duplicates_handling' , $this->gfl_options_before[ 'gfl_duplicates_handling'      ] );
			}

			// Update the options to indicate they have been processed.
			$this->gfl_options_before['installed_version'] = '99.99.91';
			update_option( $this->gfl_option_name_before, $this->gfl_options_before );

		}

		/**
		 * Migrate the options of the old Gravity Forms Integration addon.
		 */
		private function migrate_legacy_options_gfi() {
			$this->debugMP('msg', __FUNCTION__ . ' started.');

			$this->gfi_options_before = get_option( $this->gfi_option_name_before );
			$this->debugMP('pr', __FUNCTION__ . ' found options_before[' . $this->gfi_option_name_before . ']: ', $this->gfi_options_before);
			$this->debugMP('pr', __FUNCTION__ . ' found addon->options[' . $this->addon->option_name . ']: ', $this->addon->options);

			// Return when there are no options to migrate
			if ( $this->gfi_options_before === false ) {
				return;
			}

			// Migrate the options found
			$installed_version_before = $this->gfi_options_before[ 'installed_version' ];

			// Only update if not processed yet
			if ( version_compare( $installed_version_before , '99.99' , '<=' ) ) {
				$this->debugMP('pr', __FUNCTION__ . ' found addon->options[' . $this->addon->option_name . ']: ', $this->addon->options);
				// Migrate original options_before to the addon->options
				$this->addon->options[ 'gfl_form_id'                          ] = $this->gfi_options_before[ 'gfl_form_id'                          ];
				$this->addon->options[ 'gfl_form_id_selector'                 ] = $this->gfi_options_before[ 'gfl_form_id_selector'                 ];
				$this->addon->options[ 'label_for_gfl_form_id_selector'       ] = $this->gfi_options_before[ 'label_for_gfl_form_id_selector'       ];
				$this->addon->options[ 'search_by_gfl_form_id_pd_label'       ] = $this->gfi_options_before[ 'search_by_gfl_form_id_pd_label'       ];
				$this->addon->options[ 'search_for_none_gfl_form_id_pd_label' ] = $this->gfi_options_before[ 'search_for_none_gfl_form_id_pd_label' ];
				$this->addon->options[ 'gfl_show_gfl_buttons'                 ] = $this->gfi_options_before[ 'gfi_show_gfl_buttons'                 ];
				$this->addon->options[ 'gfl_allow_gfl_buttons'                ] = $this->gfi_options_before[ 'gfi_allow_gfl_buttons'                ];

				// Migrate original options_before to the SmartOptions
				$this->slplus->SmartOptions->set( 'gfl_form_id' ,                          $this->gfi_options_before[ 'gfl_form_id'                          ] );
				$this->slplus->SmartOptions->set( 'gfl_form_id_selector' ,                 $this->gfi_options_before[ 'gfl_form_id_selector'                 ] );
				$this->slplus->SmartOptions->set( 'label_for_gfl_form_id_selector' ,       $this->gfi_options_before[ 'label_for_gfl_form_id_selector'       ] );
				$this->slplus->SmartOptions->set( 'search_by_gfl_form_id_pd_label' ,       $this->gfi_options_before[ 'search_by_gfl_form_id_pd_label'       ] );
				$this->slplus->SmartOptions->set( 'search_for_none_gfl_form_id_pd_label' , $this->gfi_options_before[ 'search_for_none_gfl_form_id_pd_label' ] );
				$this->slplus->SmartOptions->set( 'gfl_show_gfl_buttons' ,                 $this->gfi_options_before[ 'gfi_show_gfl_buttons'                 ] );
				$this->slplus->SmartOptions->set( 'gfl_allow_gfl_buttons' ,                $this->gfi_options_before[ 'gfi_allow_gfl_buttons'                ] );
			}

			// Update the options to indicate they have been processed.
			$this->gfi_options_before['installed_version'] = '99.99.91';
			update_option( $this->gfi_option_name_before, $this->gfi_options_before );

		}

		/**
		 * Migrate the options of the old Gravity Forms Integration addon.
		 */
		private function set_debug_legacy_options_gfl( $debug = true ) {
			$this->debugMP('msg', __FUNCTION__ . ' started.');

			$this->gfl_options_before = get_option( $this->gfl_option_name_before );
			$this->debugMP('pr', __FUNCTION__ . ' found options_before[' . $this->gfl_option_name_before . ']: ', $this->gfl_options_before);

			// Return when there are no options to migrate
			if ( $this->gfl_options_before === false ) {
				return;
			}

			if ( $debug ) {
				// Set the options found to debug values
				$this->gfl_options_before[ 'installed_version'                    ] = '5.0.2';
				$this->gfl_options_before[ 'gfl_skip_geocoding'                   ] = '502_gfl_skip_geocoding';
				$this->gfl_options_before[ 'gfl_duplicates_handling'              ] = '502_gfl_duplicates_handling';

			} else {
				// Set the options found to original test values
				$this->gfl_options_before[ 'installed_version'                    ] = '4.8';
				$this->gfl_options_before[ 'gfl_skip_geocoding'                   ] = 'off';
				$this->gfl_options_before[ 'gfl_duplicates_handling'              ] = 'update';
			}

			// Update the options to indicate they have been processed.
			update_option( $this->gfl_option_name_before, $this->gfl_options_before );

		}

		/**
		 * Migrate the options of the old Gravity Forms Integration addon.
		 */
		private function set_debug_legacy_options_gfi( $debug = true ) {
			$this->debugMP('msg', __FUNCTION__ . ' started.');

			$this->gfi_options_before = get_option( $this->gfi_option_name_before );
			$this->debugMP('pr', __FUNCTION__ . ' found options_before[' . $this->gfi_option_name_before . ']: ', $this->gfi_options_before);

			// Return when there are no options to migrate
			if ( $this->gfi_options_before === false ) {
				return;
			}

			if ( $debug ) {
				// Set the options found to debug values
				$this->gfi_options_before[ 'installed_version'                    ] = '5.0.2';
				$this->gfi_options_before[ 'gfi_skip_geocoding'                   ] = '502_gfi_skip_geocoding';
				$this->gfi_options_before[ 'gfl_form_id'                          ] = '502_gfl_form_id';
				$this->gfi_options_before[ 'gfl_form_id_selector'                 ] = '502_gfl_form_id_selector';
				$this->gfi_options_before[ 'label_for_gfl_form_id_selector'       ] = '502_label_for_gfl_form_id_selector';
				$this->gfi_options_before[ 'search_by_gfl_form_id_pd_label'       ] = '502_search_by_gfl_form_id_pd_label';
				$this->gfi_options_before[ 'search_for_none_gfl_form_id_pd_label' ] = '502_search_for_none_gfl_form_id_pd_label';
				$this->gfi_options_before[ 'gfi_show_gfl_buttons'                 ] = '502_gfi_show_gfl_buttons';
				$this->gfi_options_before[ 'gfi_allow_gfl_buttons'                ] = '502_gfi_allow_gfl_buttons';

			} else {
				// Set the options found to original test values
				$this->gfi_options_before[ 'installed_version'                    ] = '5.0.0';
				$this->gfi_options_before[ 'gfi_skip_geocoding'                   ] = 0;
				$this->gfi_options_before[ 'gfl_form_id'                          ] = '';
				$this->gfi_options_before[ 'gfl_form_id_selector'                 ] = 'hidden';
				$this->gfi_options_before[ 'label_for_gfl_form_id_selector'       ] = '';
				$this->gfi_options_before[ 'search_by_gfl_form_id_pd_label'       ] = '';
				$this->gfi_options_before[ 'search_for_none_gfl_form_id_pd_label' ] = '';
				$this->gfi_options_before[ 'gfi_show_gfl_buttons'                 ] = 1;
				$this->gfi_options_before[ 'gfi_allow_gfl_buttons'                ] = 'gfi_allow_admin_only';
			}

			// Update the options to indicate they have been processed.
			update_option( $this->gfi_option_name_before, $this->gfi_options_before );

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
		function debugMP($type,$hdr,$msg='') {
			if (($type === 'msg') && ($msg!=='')) {
				$msg = esc_html($msg);
			}
			if (($hdr!=='')) {
				$hdr = __CLASS__ . '::' . $hdr;
			}
			SLP_Gravity_Forms_Locations_debugMP($type,$hdr,$msg,NULL,NULL,true);
		}
	}
}
