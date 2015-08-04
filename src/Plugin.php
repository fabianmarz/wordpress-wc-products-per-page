<?php

/**
 * @file
 * Contains \Netzstrategen\WooCommerce\ProductsPerPage\Plugin.
 *
 * @todo Translations
 * @todo Options registration uninstallation
 */

Namespace Netzstrategen\WooCommerce\ProductsPerPage;

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
    add_action('plugins_loaded', [__CLASS__, 'loadTextdomain']);
    add_action('wp_head', [__CLASS__, 'loadAssets']);
    add_filter('loop_shop_per_page', [__CLASS__, 'getProductCount'], 20);
    add_filter('woocommerce_before_shop_loop', [__CLASS__, 'renderDropdown'], 20);
  }

  /**
   * Gets product count for shop loop.
   * @return integer
   */
  public static function getProductCount($product_count = null) {
    $limit = get_option('wc_products_per_page');
    if (isset($_GET['product_count']) && $_GET['product_count'] <= $limit * 3 && $_GET['product_count'] % $limit == 0) {
      $limit = (int) $_GET['product_count'];
    }
    return $limit;
  }

  /**
   * Displays plugin view.
   */
  public static function renderDropdown() {
    $vars = [
      'product_count' => self::getProductCount(),
      'limit' => get_option('wc_products_per_page')
    ];
    wc_get_template('products-per-page.php', $vars, '', self::getBasePath() . '/templates/');
  }

  /**
   * Loads plugin textdomain.
   */
  public static function loadTextdomain() {
    load_plugin_textdomain('wc_products', false, self::getBasePath() . '/languages');
  }

  /**
   * Adds plugin stylesheet to head.
   */
  public static function loadAssets() {
    wp_enqueue_style('wc-products-style', self::getBaseUrl() . '/wc-products-style.css');
  }

  /**
   * The base URL to this plugin.
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
   * The base path to this plugin.
   */
  public static function getBasePath() {
    return dirname(__DIR__);
  }

}
