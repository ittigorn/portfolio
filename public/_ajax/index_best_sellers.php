<?php 
	
	require_once("../../_includes/ajax_run_first_addon.php");

	$product_array = product::fetch_products_from_category(2,TRUE);

	if (sizeof($product_array) > 0) {


?>
<div class="col-12">
	<h2><span>Best Sellers</span><br /><img src="_images/_index/lines.png" /></h2>
	<?php foreach ($product_array as $key => $product) { ?>
		<div class='product'>
			<a href="products.php?product_sku=<?php echo $product->sku; ?>">
				<div class="img_container">
					<img class="img-fluid" id="<?php echo $product->sku; ?>" src="_images/products/<?php echo $product->image_src_1; ?>" title="<?php echo $product->sku; ?>">
				</div>
				<div class="text_container">
					<h3 class="text text-center"><?php echo $product->name; ?></h3>
				</div>
				<div class="name_backdrop"></div>
			</a>
		</div>
	<?php } // end foreach ?>
</div>
<?php } // end if product array is not empty ?>