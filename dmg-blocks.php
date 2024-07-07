<?php

/**
 * Plugin Name: DMG Media Blocks
 * Description: This plugin registers custom blocks for the block editor and extra styling for common Gutenberg blocks
 * Version: 1.0.0
 * Author: DMG Raivis
 *
 * @package dmgblocks
 */

defined( 'ABSPATH' ) || exit;

define('DMGBLOCKS_ROOT_PATH', plugin_dir_path(__FILE__));
define('DMGBLOCKS_ROOT_URL', plugin_dir_url(__FILE__));

/**
 * Register and enqueue Gutenberg Blocks
 */
function register_dmg_blocks() {
    $blocksPath = DMGBLOCKS_ROOT_PATH . 'build/blocks/';
    $iterator = new DirectoryIterator($blocksPath);
    foreach ($iterator as $file) {
        if ($file->isDot()) continue;
        if ($file->isDir()) {
            register_block_type($file->getPathname());
        }
    }
}
add_action('init', 'register_dmg_blocks');

/**
 * Register and enqueue Script & Style WP Front Side
 */
function wpdocs_enqueue_custom_public_style() {
	$name       = 'public';
	$filepath   = 'build/public/' . $name;
	$asset_path = DMGBLOCKS_ROOT_PATH . $filepath . '.asset.php';
	$asset_file = file_exists( $asset_path ) ? include $asset_path : array( 'dependencies' => array(), 'version' => '1.0', );
	$script_url = DMGBLOCKS_ROOT_URL . 'build/style/public.js';
	$style_url = DMGBLOCKS_ROOT_URL . 'build/style/public.scss.css';
	$v = $asset_file['version'];
	wp_enqueue_style( 'public-dmgblocks-style', $style_url, array(), $v, 'all' );
	wp_enqueue_script( 'public-dmgblocks-style', $script_url, array(), $v, 'all' );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_enqueue_custom_public_style' );

/**
 * Register and enqueue Script & Style WP Admin Side
 */
function wpdocs_enqueue_custom_admin_style() {
	$name       = 'admin';
	$filepath   = 'build/' . $name;
	$asset_path = DMGBLOCKS_ROOT_PATH . $filepath . '.asset.php';
	$asset_file = file_exists( $asset_path ) ? include $asset_path : array( 'dependencies' => array(), 'version' => '1.0', );
	$script_url = DMGBLOCKS_ROOT_URL . 'build/style/admin.js';
	$style_url = DMGBLOCKS_ROOT_URL . 'build/style/admin.scss.css';
	$v = $asset_file['version'];
	wp_enqueue_script( 'admin-dmgblocks-style', $script_url, array(), $v, 'all' );
	wp_enqueue_style( 'admin-dmgblocks-style', $style_url, array(), $v, 'all' );
}
add_action('admin_enqueue_scripts','wpdocs_enqueue_custom_admin_style');