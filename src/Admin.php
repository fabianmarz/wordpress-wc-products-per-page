<?php

/**
 * @file
 * Contains \Netzstrategen\WooCommerce\ProductsPerPage\Admin.
 */

Namespace Netzstrategen\WooCommerce\ProductsPerPage;

class Admin {

  /**
   * @implements init
   */
  public static function init() {
    add_filter('woocommerce_get_settings_products', [__CLASS__, 'registerProductSettings'], 10, 2);
  }

  /**
   * Adds settings to the product display section.
   */
  public static function registerProductSettings($settings, $current_section) {
    if ($current_section == 'display') {
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
