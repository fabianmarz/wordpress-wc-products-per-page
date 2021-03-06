<?php

/**
 * Template for WooCommerce products per page select dropdown.
 *
 * @version 1.0.0
 */

use Netzstrategen\Woocommerce\ProductsPerPage\Plugin;
?>
<form class="woocommerce-ordering wc-products-per-page">
<?php foreach ($_GET as $key => $value): ?>
<?php if ($key !== 'product_count'): ?>
    <input type="hidden" name="<?= $key; ?>" value="<?= $value ; ?>">
<?php endif ?>
<?php endforeach ?>
  <select name="product_count" class="orderby">
<?php for ($i = 1; $i <= 3; $i++): ?>
    <option value="<?= $limit * $i; ?>" <?= $product_count == $limit * $i ? 'selected' : ''; ?>><?= $product_count == -1 ? __('all', Plugin::L10N) : sprintf(__('%d per page', Plugin::L10N), $limit * $i); ?></option>
<?php endfor; ?>
  </select>
</form>
