<?php

defined( 'ABSPATH' ) || exit;
require_once SLPLUS_PLUGINDIR . '/include/base/SLP_AddOn_Options.php';
/**
 * Class SLP_Gravity_Forms_Locations_Options
 */
class SLP_Gravity_Forms_Locations_Options extends SLP_AddOn_Options
{
    /**
     * Create our options.
     */
    protected function create_options()
    {
        global  $slplus ;
        $this->addon = SLP_Gravity_Forms_Locations_Get_Instance();
        $this->slplus = $slplus;
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
        SLP_Gravity_Forms_Locations_Text::get_instance();
        // General SLP_Gravity_Forms_Locations options
        $this->augment_gfl_settings_page_options();
    }
    
    /**
     * Free SLP_Gravity_Forms_Locations Options
     */
    private function augment_gfl_settings_page_options()
    {
        $new_options['gfl_skip_geocoding'] = array(
            'type'    => 'checkbox',
            'default' => '1',
        );
        $gfl_duplicates_handling_options = array();
        $gfl_duplicates_handling_options[] = array(
            'label' => 'Add',
            'value' => SLP_GFL_DUPLICATES_HANDLING_ADD,
        );
        $gfl_duplicates_handling_options[] = array(
            'label' => 'Skip',
            'value' => SLP_GFL_DUPLICATES_HANDLING_SKIP,
        );
        $gfl_duplicates_handling_options[] = array(
            'label' => 'Update',
            'value' => SLP_GFL_DUPLICATES_HANDLING_UPDATE,
        );
        $new_options['gfl_duplicates_handling'] = array(
            'default' => SLP_GFL_DUPLICATES_HANDLING_UPDATE,
            'type'    => 'dropdown',
            'options' => $gfl_duplicates_handling_options,
        );
        $this->attach_to_slp( $new_options, array(
            'page'    => SLP_GFL_ADMIN_PAGE_SLUG,
            'section' => SLP_GFL_SETTINGS_SECTION,
            'group'   => SLP_GFL_SETTINGS_GROUP_FREE,
        ) );
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