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

use Fragen\Git_Updater\Traits\GHU_Trait;

/**
 * Class Remote_Management
 */
class Remote_Management {
	use GHU_Trait;

	/**
	 * Holds the value for the Remote Management API key.
	 *
	 * @var string $api_key
	 */
	private static $api_key;

	/**
	 * Remote_Management constructor.
	 */
	public function __construct() {
		$this->load_options();
		$this->ensure_api_key_is_set();
	}

	/**
	 * Load site options.
	 */
	private function load_options() {
		self::$api_key = get_site_option( 'github_updater_api_key' );
	}

	/**
	 * Ensure api key is set.
	 */
	public function ensure_api_key_is_set() {
		if ( ! self::$api_key ) {
			update_site_option( 'github_updater_api_key', md5( uniqid( \wp_rand(), true ) ) );
		}
	}

	/**
	 * Load needed action/filter hooks.
	 */
	public function load_hooks() {
		add_action( 'admin_init', [ $this, 'remote_management_page_init' ] );
		add_action(
			'gu_update_settings',
			function ( $post_data ) {
				$this->save_settings( $post_data );
			}
		);
		$this->add_settings_tabs();
	}

	/**
	 * Save Remote Management settings.
	 *
	 * @uses 'gu_settings' action hook
	 * @uses 'gu_save_redirect' filter hook
	 *
	 * @param array $post_data $_POST data.
	 */
	public function save_settings( $post_data ) {
		if ( isset( $post_data['option_page'] )
			&& 'github_updater_remote_management' === $post_data['option_page']
		) {
			$options = isset( $post_data['github_updater_remote_management'] )
				? $post_data['github_updater_remote_management']
				: [];

			update_site_option( 'github_updater_remote_management', (array) $this->sanitize( $options ) );

			add_filter(
				'gu_save_redirect',
				function ( $option_page ) {
					return array_merge( $option_page, [ 'github_updater_remote_management' ] );
				}
			);
		}
	}

	/**
	 * Adds Remote Management tab to Settings page.
	 */
	public function add_settings_tabs() {
		$install_tabs = [ 'github_updater_remote_management' => esc_html__( 'Remote Management', 'git-updater-pro' ) ];
		add_filter(
			'gu_add_settings_tabs',
			function ( $tabs ) use ( $install_tabs ) {
				return array_merge( $tabs, $install_tabs );
			}
		);
		add_filter(
			'gu_add_admin_page',
			function ( $tab, $action ) {
				$this->add_admin_page( $tab, $action );
			},
			10,
			2
		);
	}

	/**
	 * Add Settings page data via action hook.
	 *
	 * @uses 'gu_add_admin_page' action hook
	 *
	 * @param string $tab    Tab name.
	 * @param string $action Form action.
	 */
	public function add_admin_page( $tab, $action ) {
		if ( 'github_updater_remote_management' === $tab ) {
			$action = add_query_arg( 'tab', $tab, $action ); ?>
			<form class="settings" method="post" action="<?php esc_attr_e( $action ); ?>">
				<?php do_settings_sections( 'github_updater_remote_settings' ); ?>
			</form>
			<?php $reset_api_action = add_query_arg( [ 'github_updater_reset_api_key' => true ], $action ); ?>
			<form class="settings no-sub-tabs" method="post" action="<?php esc_attr_e( $reset_api_action ); ?>">
				<?php submit_button( esc_html__( 'Reset REST API key', 'git-updater-pro' ) ); ?>
			</form>
			<?php
		}
	}

	/**
	 * Settings for Remote Management.
	 */
	public function remote_management_page_init() {
		register_setting(
			'github_updater_remote_management',
			'github_updater_remote_settings',
			[ $this, 'sanitize' ]
		);

		add_settings_section(
			'remote_management',
			esc_html__( 'Remote Management', 'git-updater-pro' ),
			[ $this, 'print_section_remote_management' ],
			'github_updater_remote_settings'
		);
	}

	/**
	 * Print the Remote Management text.
	 */
	public function print_section_remote_management() {
		if ( empty( self::$api_key ) ) {
			$this->load_options();
		}
		$api_url = add_query_arg(
			[ 'key' => self::$api_key ],
			home_url( 'wp-json/' . $this->get_class_vars( 'REST\REST_API', 'namespace' ) . '/update/' )
		);

		echo '<p>';
		esc_html_e( 'Remote Management services should just work for plugins like MainWP, ManageWP, InfiniteWP, iThemes Sync and others.', 'git-updater-pro' );
		echo '</p>';

		echo '<p>';
		printf(
			wp_kses_post(
				/* translators: %s: Link to Git Remote Updater repository */
				__( 'The <a href="%s">Git Remote Updater</a> plugin was specifically created to make the remote management of Git Updater supported plugins and themes much simpler. You will need the Site URL and REST API key to use with Git Remote Updater settings.', 'git-updater-pro' )
			),
			'https://github.com/afragen/git-remote-updater'
		);
		echo '</p>';

		echo '<p>';
		printf(
			wp_kses_post(
				/* translators: 1: home URL, 2: REST API key */
				__( 'Site URL: %1$s<br> REST API key: %2$s', 'git-updater-pro' )
			),
			'<span style="font-family:monospace;">' . esc_url( home_url() ) . '</span>',
			'<span style="font-family:monospace;">' . esc_attr( self::$api_key ) . '</span>'
		);
		echo '</p>';

		echo '<p>';
		printf(
			wp_kses_post(
				/* translators: 1: Link to wiki, 2: RESTful API URL */
				__( 'Please refer to the <a href="%1$s">wiki</a> for complete list of attributes. REST API endpoints for webhook updating begin at: %2$s', 'git-updater-pro' )
			),
			'https://github.com/afragen/github-updater/wiki/Remote-Management---RESTful-Endpoints',
			'<br><span style="font-family:monospace;">' . esc_url( $api_url ) . '</span>'
		);
		echo '</p>';
	}

	/**
	 * Reset RESTful API key.
	 * Deleting site option will cause it to be re-created.
	 *
	 * @return bool
	 */
	public function reset_api_key() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( isset( $_REQUEST['tab'], $_REQUEST['github_updater_reset_api_key'] )
			&& 'github_updater_remote_management' === sanitize_file_name( wp_unslash( $_REQUEST['tab'] ) )
		) {
			$_POST = $_REQUEST;
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$_POST['_wp_http_referer'] = isset( $_SERVER['HTTP_REFERER'] ) ? esc_url( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : null;
			// phpcs:enable
			delete_site_option( 'github_updater_api_key' );

			return true;
		}

		return false;
	}
}
