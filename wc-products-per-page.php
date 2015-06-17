<?php
/*
  Plugin Name: WooCommerce Products Per Page Dropdown
  Plugin URI: http://wordpress.org/plugins/wc-products-per-page/
  Version: 1.0.0
  Text Domain: wc-products-per-page
  Description: Display a products per page dropdown menu
  Author: Fabian Marz
  Author URI: http://netzstrategen.com
  License: GPLv2 or later
*/

namespace Netzstrategen\WooCommerce\ProductsPerPage;

if (!defined('ABSPATH')) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
  exit;
}

/**
 * Loads PSR-4-style plugin classes.
 */
function classloader($class) {
  static $ns_offset;
  if (strpos($class, __NAMESPACE__) === 0) {
    if ($ns_offset === NULL) {
      $ns_offset = strlen(__NAMESPACE__) + 1;
    }
    include __DIR__ . '/src/' . strtr(substr($class, $ns_offset), '\\', '/') . '.php';
  }
}
spl_autoload_register('\\' . __NAMESPACE__ . '\classloader');

register_activation_hook(__FILE__, ['\\' . __NAMESPACE__ . '\Schema', 'activate']);
register_deactivation_hook(__FILE__, ['\\' . __NAMESPACE__ . '\Schema', 'deactivate']);
register_uninstall_hook(__FILE__, ['\\' . __NAMESPACE__ . '\Schema', 'uninstall']);

add_action('init', ['\\' . __NAMESPACE__ . '\Plugin', 'init']);
add_action('admin_init', ['\\' . __NAMESPACE__ . '\Admin', 'init']);
