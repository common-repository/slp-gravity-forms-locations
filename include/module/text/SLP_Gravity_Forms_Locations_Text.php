<?php

defined( 'ABSPATH' ) || exit;
/**
 * Augment the SLP text tables.
 *
 * @var array    text    array of our text modifications key => SLP text manager slug, value = our replacement text
 */
class SLP_Gravity_Forms_Locations_Text extends SLPlus_BaseClass_Object
{
    private  $text ;
    /**
     * Things we do at the start.
     */
    public function initialize()
    {
        add_filter(
            'slp_get_text_string',
            array( $this, 'augment_text_string' ),
            10,
            2
        );
        $this->debugMP( 'msg', __FUNCTION__ . ' started.' );
    }
    
    /**
     * Replace the SLP Text Manager Strings at startup.
     *
     * @param string $text the original text
     * @param string $slug the slug being requested
     *
     * @return string            the new SLP text manager strings
     */
    public function augment_text_string( $text, $slug )
    {
        $this->init_text();
        if ( !is_array( $slug ) ) {
            $slug = array( 'general', $slug );
        }
        if ( isset( $this->text[$slug[0]] ) && isset( $this->text[$slug[0]][$slug[1]] ) ) {
            return $this->text[$slug[0]][$slug[1]];
        }
        return $text;
    }
    
    /**
     * Initialize our text modification array.
     */
    private function init_text()
    {
        if ( isset( $this->text ) ) {
            return;
        }
        $this->init_text_sections_and_groups();
        $this->init_text_gravity_forms_locations_section();
        $this->text['settings_group_header'] = $this->text['settings_group'];
    }
    
    /**
     * Initialize our text modification array for sections and groups.
     */
    private function init_text_sections_and_groups()
    {
        // Sections
        $this->text['settings_section'][SLP_GFL_SETTINGS_SECTION] = __( 'Gravity Forms Section', 'slp-gravity-forms-locations' );
        // Groups
        $this->text['settings_group'][SLP_GFL_SETTINGS_GROUP_FREE] = __( 'Free Settings', 'slp-gravity-forms-locations' );
        $this->text['settings_group'][SLP_GFL_SETTINGS_GROUP_EXPLANATION] = __( 'Explanation', 'slp-gravity-forms-locations' );
        $this->text['settings_group'][SLP_GFL_SEARCH_GRAVITY_FORMS_GROUP] = __( 'Gravity Forms Locations', 'slp-gravity-forms-locations' );
    }
    
    /**
     * Initialize our text modification array.
     */
    private function init_text_gravity_forms_locations_section()
    {
        // Labels
        $this->text['label']['gfl_skip_geocoding'] = __( 'Skip Geocoding', 'slp-gravity-forms-locations' );
        $this->text['label']['gfl_duplicates_handling'] = __( 'Duplicates Handling', 'slp-gravity-forms-locations' );
        // Descriptions
        $this->text['description']['gfl_skip_geocoding'] = __( 'When enabled, the geocode of a newly entered location is skipped to block publishing.', 'slp-gravity-forms-locations' ) . ' ' . __( 'When disabled, a newly entered location is published immediately.', 'slp-gravity-forms-locations' ) . ' ' . sprintf( __( 'This needs the re-geocoding functionality of %s to publish blocked locations.', 'slp-gravity-forms-locations' ), $this->slplus->Text->get_web_link( 'shop_for_power' ) );
        $this->text['description']['gfl_duplicates_handling'] = __( 'How should duplicates be handled?', 'slp-gravity-forms-locations' ) . ' ' . __( 'Duplicates are records that match on name and complete address with country.', 'slp-gravity-forms-locations' ) . '<br/>' . __( 'Add (default) will add new records when duplicates are encountered.', 'slp-gravity-forms-locations' ) . '<br/>' . __( 'Skip will not process duplicate records.', 'slp-gravity-forms-locations' ) . '<br/>' . __( 'Update will update duplicate records.', 'slp-gravity-forms-locations' ) . '<br/>' . __( 'To update name and address fields the CSV must have the ID column with the ID of the existing location.', 'slp-gravity-forms-locations' );
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