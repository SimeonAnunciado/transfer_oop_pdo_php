<?php require_once 'assets/header.php'; ?>
	

	<?php if (isLoggedIn()) : ?>
	<div class="container">
		<a href="add_product.php" class="btn btn-primary">Add Product</a>
		<a href="transfer_process.php" class="btn btn-primary pull-right">Transfer Process <span class="badge"><?php $process->processCount(); ?></span></a>
		<br><br>

		<?php if( $process->check_if_have_data()) : ?>

			<form action="">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search Products....." id="search_btn">
				</div>
			</form>

			
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center">Product Code</th>
					<th class="text-center">Product Name</th>
					<th class="text-center">Product Desciption</th>
					<th class="text-center" width="110">Product Qtty</th>
					<th class="text-center" width="110">Product Srp</th>
					<th class="text-center" width="110">Branch</th>
					<th class="text-center" width="180">Created At</th>
					<th class="text-center" width="250">Action</th>
				</tr>
			</thead>
			<tbody id="tbody">

				<?php foreach ($process->select_all_products() as $product ) : ?>
					<?php $product_id_link = password_hash($product->id , PASSWORD_DEFAULT) . ';' . $product->id .';'. password_hash($product->id , PASSWORD_DEFAULT); ?>	
					<tr>
						<td class="text-center"><?php echo $product->product_code ?></td>
						<td class="text-center"><?php echo $product->product_name ?></td>
						<td class="text-center"><?php echo $product->product_description ?></td>
						<td class="text-center"><?php echo $product->product_qtty ?></td>
						<td class="text-center"><?php echo $product->product_srp ?></td>
						<td class="text-center"><?php echo $product->product_branch ?></td>
						<td class="text-center"><?php echo $product->created_at ?></td>
						<td class="text-center">
							<a href="store_transfer.php?transf_id=<?php echo $product->id ?> " class="btn btn-warning">Transfer</a>&nbsp;
							<a href="view.php?id=<?php echo $product_id_link ?> " class="btn btn-success">View</a>
						</td>
					</tr>
					

				<?php endforeach ?>
			</tbody>
			<tbody id="tbody_response"></tbody>
		</table>
		<?php else: ?>
			<?php setMessage('No Data Found' , 'success'); ?>

		<?php endif ?>




	</div>
	<?php endif ?>




<?php require_once 'assets/footer.php' ?>