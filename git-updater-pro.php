<?php
/**
 * Git Updater PRO
 *
 * @author   Andy Fragen
 * @license  MIT
 * @link     https://github.com/afragen/git-updater-pro
 * @package  git-updater-pro
 */

/**
 * Plugin Name:       Git Updater PRO
 * Plugin URI:        https://github.com/afragen/git-updater-pro
 * Description:       A Git Updater add-on plugin that unlocks PRO features of updating and installing plugins and themes.
 * Version:           0.1.0
 * Author:            Andy Fragen
 * License:           MIT
 * Domain Path:       /languages
 * Text Domain:       git-updater-pro
 * Network:           true
 * GitHub Plugin URI: https://github.com/afragen/git-updater-pro
 * xGitHub Languages:  https://github.com/afragen/git-updater-pro-translations
 * Primary Branch:    main
 * Requires at least: 5.2
 * Requires PHP:      7.0
 */

namespace Fragen\Git_Updater\PRO;

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load the Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

( new Init() )->load_hooks();
