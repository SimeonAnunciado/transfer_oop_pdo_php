<?php require_once 'assets/header.php'; ?>


<?php 

if (isset($_GET['id'])) {
	$get_id = explode(';', $_GET['id']);
	$product_id = $get_id[1];
	$all_product_id = $process->all_product_id();


	if (in_array($product_id,$all_product_id )) {
		$product_details = $process->get_single_product($product_id);
	}else{
		header('location:index.php');
	}

}else{
	header('location:index.php');
}


 ?>



	<div class="container">
		<a href="index.php" class="btn btn-primary">Back to Home</a>
		<br><br>
		
		<div class="panel panel-default">
			<div class="panel-heading">Product Form</div>

			<div class="panel-body">

				<?php $process->update_product(); ?>

				<form action="#" method="POST">
					<div class="form-group">
						<input type="hidden" class="form-control" name="product_id_hidden" value="<?php echo $product_details->id ?>">
					</div>
					<div class="form-group">
						<label for="">Product Name</label>
						<input type="text" class="form-control" name="product_name" placeholder="Product Name" required value="<?php echo $product_details->product_name ?>">
					</div>
					<div class="form-group">
						<label for="">Product Description</label>
						<textarea name="product_description" id="product_description"  rows="3" class="form-control" placeholder="Product Description" required><?php echo $product_details->product_description ?></textarea>
					</div>

					<div class="form-group">
						<label for="">Product Quantity</label>
						<input type="number" class="form-control" name="product_qtty"  placeholder="Product Quantity" required value="<?php echo $product_details->product_qtty ?>">
					</div>
					<div class="form-group">
						<label for="">Product SRP</label>
						<input type="number" class="form-control" name="product_srp" placeholder="Product SRP" required value="<?php echo $product_details->product_srp ?>">
					</div>
					<input type="submit" name="update_entry_submit" class="btn btn-primary btn-block" value="UPDATE">
				</form>
			</div>

		</div>
		
		
	</div>

<?php require_once 'assets/footer.php'; ?>
