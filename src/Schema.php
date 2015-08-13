<?php

/**
 * @file
 * Contains \Netzstrategen\WooCommerce\ProductsPerPage\Schema.
 */

namespace Netzstrategen\WooCommerce\ProductsPerPage;

/**
 * Generic plugin lifetime and maintenance functionality.
 */
class Schema {

  /**
   * register_activation_hook() callback.
   */
  public static function activate() {
    // Use WordPress's (blog) posts per page setting as initial default value
    // (like WooCommerce does).
    add_option('wc_products_per_page', get_option('posts_per_page'));
  }

  /**
   * register_deactivation_hook() callback.
   */
  public static function deactivate() {
  }

  /**
   * register_uninstall_hook() callback.
   */
  public static function uninstall() {
    delete_option('wc_products_per_page');
  }

}
