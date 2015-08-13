<?php

/**
 * @file
 * Contains \Netzstrategen\WooCommerce\ProductsPerPage\Admin.
 */

namespace Netzstrategen\WooCommerce\ProductsPerPage;

/**
 * Administrative back-end functionality.
 */
class Admin {

  /**
   * @implements admin_init
   */
  public static function init() {
    add_filter('woocommerce_get_settings_products', __CLASS__ . '::registerProductSettings', 10, 2);
  }

  /**
   * Adds settings for this plugin to WooCommerce's product display settings section.
   */
  public static function registerProductSettings(array $settings, $current_section) {
    if ($current_section === 'display') {
      $product_settings[] = [
        'name' => __('Products per page', Plugin::L10N),
        'id' => 'wc_products_per_page',
        'type' => 'number',
        'custom_attributes' => ['min' => 10, 'max' => 200],
      ];
      array_splice($settings, 4, 0, $product_settings);
    }
    return $settings;
  }

}
