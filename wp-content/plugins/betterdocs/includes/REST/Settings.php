<?php

namespace WPDeveloper\BetterDocs\REST;

use WPDeveloper\BetterDocs\Admin\ReportEmail;
use WP_REST_Request;
use WPDeveloper\BetterDocs\Core\BaseAPI;

class Settings extends BaseAPI {

    public function permission_check() {
        return current_user_can( 'edit_docs_settings' );
    }

    public function register() {
        $this->get( 'settings', [$this, 'get_settings'] );
        $this->post( 'settings', [$this, 'save_settings'] );
        $this->post( 'plugin_insights', [$this, 'plugin_insights'] );

        $this->post( 'reporting-test', [$this, 'test_reporting'] );
    }

    public function insights(){
        return true;
    }

    public function get_settings() {
        return betterdocs()->settings->get_all( true );
    }

    public function save_settings( WP_REST_Request $request ) {
        if ( betterdocs()->settings->save_settings( $request->get_params() ) ) {
            return $this->success( __( 'Settings Saved!', 'betterdocs' ) );
        }

        return $this->error( 'nothing_changed', __( 'There are no changes to be saved.', 'betterdocs' ), 200 );
    }

    public function test_reporting( $request ){
        return $this->container->get(ReportEmail::class)->test_email_report( $request );
    }

    public function do_wizard_tracking() {
		$insights = betterdocs()->admin->plugin_insights( true );
		// Get our data
		$insights->schedule_tracking();
        $insights->set_is_tracking_allowed( true, 'betterdocs' );
        if ( $insights->do_tracking( true ) ) {
            $insights->update_block_notice( 'betterdocs' );
        }

        return true;
	}

    public function plugin_insights( $request ){
        if ( $this->do_wizard_tracking() ) {
            wp_send_json_success('done');
        }
        wp_send_json_error('Something went wrong.');
    }
}
