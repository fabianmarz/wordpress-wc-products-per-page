<?php
/**
 * Displays products per page dropdown.
 *
 * @author Fabian Marz
 * @version 1.0.0
 */

use Netzstrategen\Woocommerce\ProductsPerPage\Plugin;

?>
<form class="woocommerce-ordering wc-products-per-page">
	<select name="product_count" class="orderby">
		<?php for ($i = 1; $i <= 3; $i++) { ?>
			<option value="<?= $limit * $i; ?>" <?= $product_count == $limit * $i ? 'selected' : ''; ?>><?= $option == -1 ? __('all', Plugin::L10N) : sprintf(__('%d per page', Plugin::L10N), $limit * $i); ?></option>
		<?php } ?>
	</select>
</form>
