<?php
/**
 * Plugin Name: Ecommerce Block
 * Description: Advanced Custom Field blocks for ecommerce.
 * Version: 1.0.0
 * Author: Iheb Grayaa
 * Author URI: https://www.linkedin.com/in/grayaa-iheb/
 *
 * Ecommerce Block Plugin
 *
 * This plugin provides a modular system of custom Gutenberg blocks
 * built with Advanced Custom Fields (ACF), designed specifically
 * for ecommerce use cases.
 *
 * The plugin uses a kernel-based architecture to:
 * - Bootstrap the plugin lifecycle
 * - Dynamically load block addons
 * - Provide an admin interface to enable/disable blocks
 *
 * @package EcommerceBlock
 */

use EcommerceBlock\Kernel;

/**
 * Absolute path to the plugin directory.
 *
 * @var string
 */
define('ECOMMERCE_BLOCK_PATH', plugin_dir_path(__FILE__));

/**
 * URL to the plugin directory.
 *
 * @var string
 */
define('ECOMMERCE_BLOCK_URL', plugin_dir_url(__FILE__));

/**
 * Text domain used for translations.
 *
 * @var string
 */
define('ECOMMERCE_TEXT_DOMAINE', 'ecommerce-block');

/**
 * Load Composer autoloader.
 *
 * Ensures all plugin classes and dependencies are
 * automatically loaded.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Boot the plugin kernel.
 *
 * Initializes block registration, admin menus,
 * and required WordPress hooks.
 */
Kernel::boot();
