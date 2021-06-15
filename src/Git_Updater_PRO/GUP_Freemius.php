<?php
/**
 * Git Updater PRO
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/git-updater-pro
 * @package  git-updater-pro
 */

namespace Fragen\Git_Updater\PRO;

/*
 * Exit if called directly.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Freemius integration.
 */
class GUP_Freemius {

	/**
	 * Freemius integration.
	 *
	 * @return array|void
	 */
	public function init() {
		require_once dirname( __DIR__, 2 ) . '/vendor/freemius/wordpress-sdk/start.php';

		if ( ! function_exists( 'gup_fs' ) ) {

			/**
			 * Create a helper function for easy SDK access.
			 *
			 * @return \stdClass
			 */
			function gup_fs() {
				global $gup_fs;

				if ( ! isset( $gup_fs ) ) {
					// Activate multisite network integration.
					if ( ! defined( 'WP_FS__PRODUCT_8282_MULTISITE' ) ) {
						define( 'WP_FS__PRODUCT_8282_MULTISITE', true );
					}

					$gup_fs = fs_dynamic_init(
						[
							'id'               => '8282',
							'slug'             => 'git-updater-pro',
							'premium_slug'     => 'git-updater-pro',
							'type'             => 'plugin',
							'public_key'       => 'pk_f1aa373a315f6fab36235b65cf5b1',
							'is_premium'       => true,
							'is_premium_only'  => true,
							'has_addons'       => false,
							'has_paid_plans'   => true,
							'is_org_compliant' => false,
							'trial'            => [
								'days'               => 10,
								'is_require_payment' => true,
							],
							'menu'             => [
								'slug'    => 'git-updater',
								'support' => false,
								'network' => true,
								'parent'  => [
									'slug' => is_multisite() ? 'settings.php' : 'options-general.php',
								],
							],
							// Set the SDK to work in a sandbox mode (for development & testing).
							// IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
							'secret_key'       => 'sk_6cE{A)VfWZdisbVud{*28Xbk97V;i',
						]
					);
				}

				return $gup_fs;
			}

			// Init Freemius.
			gup_fs();
			// Signal that SDK was initiated.
			do_action( 'gup_fs_loaded' );
		}
		gup_fs()->add_filter( 'plugin_icon', [ $this, 'add_icon' ] );
	}

	/**
	 * Add custom plugin icon to update notice.
	 *
	 * @return string
	 */
	public function add_icon() {
		return dirname( __DIR__, 2 ) . '/assets/icon.svg';
	}
}
