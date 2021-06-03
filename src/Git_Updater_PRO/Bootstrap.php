<?php
/**
 * Git Updater PRO
 *
 * @author    Andy Fragen
 * @license   MIT
 * @link      https://github.com/afragen/git-updater-pro
 * @package   git-updater-pro
 */

namespace Fragen\Git_Updater\PRO;

use Fragen\Singleton;
use Fragen\Git_Updater\Traits\GU_Trait;
use Fragen\Git_Updater\PRO\REST\REST_API;

/*
 * Exit if called directly.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Bootstrap
 */
class Bootstrap {
	use GU_Trait;

	/**
	 * Run the bootstrap.
	 *
	 * @return bool|void
	 */
	public function run() {
		if ( ! gup_fs()->can_use_premium_code() ) {
			return;
		}
		$this->load_hooks();

		if ( static::is_wp_cli() ) {
			include_once __DIR__ . '/WP_CLI/CLI.php';
			include_once __DIR__ . '/WP_CLI/CLI_Integration.php';
		}

		// Need to ensure these classes are activated here for hooks to fire.
		if ( $this->is_current_page( [ 'options.php', 'options-general.php', 'settings.php', 'edit.php' ] ) ) {
			Singleton::get_instance( 'Install', $this )->run();
			Singleton::get_instance( 'Remote_Management', $this )->load_hooks();
		}
	}

	/**
	 * Load hooks.
	 *
	 * @return void
	 */
	public function load_hooks() {
		add_action( 'rest_api_init', [ new REST_API(), 'register_endpoints' ] );

		// Deprecated AJAX request.
		add_action( 'wp_ajax_git-updater-update', [ Singleton::get_instance( 'REST\Rest_Update', $this ), 'process_request' ] );
		add_action( 'wp_ajax_nopriv_git-updater-update', [ Singleton::get_instance( 'REST\Rest_Update', $this ), 'process_request' ] );

		/**
		 * Simple filter to turn on normal API checks, etc.
		 *
		 * @since Git Updater 10.2.0
		 */
		if ( ! \apply_filters( 'gu_test_premium_plugins', false ) ) {
			// Use Freemius, not Git Updater.
			add_filter(
				'gu_config_pre_process',
				function( $config ) {
					unset( $config['git-updater-pro'] );

					return $config;
				},
				10,
				1
			);

			// Skip on waiting for background tasks.
			add_filter(
				'gu_github_api_no_wait',
				function( $repos ) {
					unset( $repos['git-updater-pro'] );

					return $repos;
				},
				10,
				1
			);

			// Fix to display properly in GitHub subtab.
			add_filter(
				'gu_display_repos',
				function( $type_repos ) {
					if ( isset( $type_repos['git-updater-pro'] ) ) {
						$type_repos['git-updater-pro']->is_private     = true;
						$type_repos['git-updater-pro']->remote_version = true;
					}

					return $type_repos;
				},
				10,
				1
			);

			// Don't display token field.
			add_filter(
				'gu_add_repo_setting_field',
				function( $arr, $token ) {
					if ( 'git-updater-pro/git-updater-pro.php' === $token->file ) {
						$arr = [];
					}

					return $arr;
				},
				15,
				2
			);
		}
	}
}
