<?php
/**
 * Plugin Name: Ecommerce Block
 * Description: Advanced Custom Field blocks for ecommerce.
 * Version: 1.0.0
 * Author: Iheb Grayaa
 * Author URI: https://www.linkedin.com/in/grayaa-iheb/
 */


use EcommerceBlock\Kernel;

define('ECOMMERCE_BLOCK_PATH', plugin_dir_path(__FILE__));
define('ECOMMERCE_BLOCK_URL', plugin_dir_url(__FILE__));
define('ECOMMERCE_TEXT_DOMAINE', 'ecommerce-block');

require_once __DIR__ . '/vendor/autoload.php';
Kernel::boot();
