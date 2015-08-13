<?php

/**
 * @file
 * Contains \Netzstrategen\WooCommerce\ProductsPerPage\Plugin.
 */

namespace Netzstrategen\WooCommerce\ProductsPerPage;

/**
 * Main front-end functionality.
 */
class Plugin {

  /**
   * Gettext localization domain.
   *
   * @var string
   */
  const L10N = 'wc-products-per-page';

  /**
   * @var string
   */
  private static $baseUrl;

  /**
   * @implements init
   */
  public static function init() {
    add_action('plugins_loaded', __CLASS__ . '::loadTextdomain');
    add_action('wp_head', __CLASS__ . '::loadAssets');
    add_filter('loop_shop_per_page', __CLASS__ . '::getProductCount', 20);
    add_filter('woocommerce_before_shop_loop', __CLASS__ . '::renderDropdown', 20);
  }

  /**
   * Returns the numeric limit for the products to display in the shop loop.
   *
   * @return int
   */
  public static function getProductCount($product_count = NULL) {
    $limit = get_option('wc_products_per_page');
    // User input may not exceed the maximum limit and must always be a multiple
    // of the configured limit.
    if (isset($_GET['product_count']) && $_GET['product_count'] <= $limit * 3 && $_GET['product_count'] % $limit == 0) {
      $limit = (int) $_GET['product_count'];
    }
    return $limit;
  }

  /**
   * Outputs the select dropdown menu form element.
   */
  public static function renderDropdown() {
    $vars = [
      'product_count' => self::getProductCount(),
      'limit' => get_option('wc_products_per_page'),
    ];
    wc_get_template('products-per-page.php', $vars, '', self::getBasePath() . '/templates/');
  }

  /**
   * Loads the plugin textdomain.
   */
  public static function loadTextdomain() {
    load_plugin_textdomain('wc_products', FALSE, self::getBasePath() . '/languages');
  }

  /**
   * Adds the plugin stylesheet.
   */
  public static function loadAssets() {
    wp_enqueue_style('wc-products-style', self::getBaseUrl() . '/wc-products-style.css');
  }

  /**
   * The base URL path to this plugin's folder.
   *
   * Uses plugins_url() instead of plugin_dir_url() to avoid a trailing slash.
   */
  public static function getBaseUrl() {
    if (!isset(self::$baseUrl)) {
      self::$baseUrl = plugins_url('', dirname(__DIR__) . '/wc-products-per-page.php');
    }
    return self::$baseUrl;
  }

  /**
   * The absolute filesystem base path of this plugin.
   *
   * @return string
   */
  public static function getBasePath() {
    return dirname(__DIR__);
  }

}
