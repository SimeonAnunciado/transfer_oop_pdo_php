<?php require_once 'assets/header.php'; ?>
	

	<?php if (isLoggedIn()) : ?>
	<div class="container">
		<a href="add_product.php" class="btn btn-primary">Back to Home</a>
		<br><br>


		

				<?php if ($process->check_if_have_data_request_transfer()) : ?>

					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search Products.....">
						</div>
					</form>


					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center">From Branch</th>
								<th class="text-center">To </th>
								<th class="text-center">Date Request</th>
								<th class="text-center">Action</th>

							</tr>
						</thead>
						<tbody>

							<?php foreach ($process->requesting_transfer() as $request ) : ?>
							<?php $product_id_link = $request->product_code; ?>

								<tr>
									<td class="text-center"><?php echo $request->from_branch ?></td>
									<td class="text-center"><?php echo $request->to_branch ?></td>
									<td class="text-center"><?php echo $request->created_at ?></td>

									<td class="text-center">
										<a href="#" class="btn btn-danger decline_request"  alt="<?php echo $product_id_link ?>">Decline</a>
										<a href="#" class="btn btn-success approve_request" alt="<?php echo $product_id_link ?>">Approve</a>
									</td>
								</tr>

							<?php endforeach ?> 

						</tbody>
					</table>

				<?php else: ?>

					<?php setMessage('No Data Request Found' , 'success'); ?>

				<?php endif ?>
	
	</div>
	<?php endif ?>




<?php require_once 'assets/footer.php' ?>