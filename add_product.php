<?php require_once 'assets/header.php'; ?>

	<div class="container">
		<a href="index.php" class="btn btn-primary">Back to Home</a>
		<br><br>
		
		<div class="panel panel-default">
			<div class="panel-heading">Product Form</div>

			<div class="panel-body">

				<?php $process->product_entry(); ?>

				<form action="#" method="POST">
		

					<div class="form-group">
						<label for="">Product Name</label>
						<input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
					</div>
					<div class="form-group">
						<label for="">Product Description</label>
						<textarea name="product_description" id="product_description"  rows="3" class="form-control" placeholder="Product Description" required></textarea>
					</div>

					<div class="form-group">
						<label for="">Product Quantity</label>
						<input type="number" class="form-control" name="product_qtty"  placeholder="Product Quantity" required>
					</div>
					<div class="form-group">
						<label for="">Product SRP</label>
						<input type="number" class="form-control" name="product_srp" placeholder="Product SRP" required>
					</div>
					<input type="submit" name="product_entry_submit" class="btn btn-primary btn-block" value="SUBMIT PRODUCT">
				</form>
			</div>

		</div>
		
		
	</div>

<?php require_once 'assets/footer.php'; ?>