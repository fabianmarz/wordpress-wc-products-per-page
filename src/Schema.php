<?php

/**
 * @file
 * Contains \Netzstrategen\WooCommerce\ProductsPerPage\Schema.
 */

Namespace Netzstrategen\WooCommerce\ProductsPerPage;

class Schema {


  /**
   * register_activation_hook() callback.
   */
  public static function activate() {
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
