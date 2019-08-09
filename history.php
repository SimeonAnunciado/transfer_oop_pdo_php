<?php require_once 'assets/header.php'; ?>
	

	<?php if (isLoggedIn()) : ?>
	<div class="container">
		<a href="add_product.php" class="btn btn-primary">Back to Home</a>
		<br><br>




		<?php if($process->check_if_have_data_history_transfer()) :  ?>

			<form action="">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search Products....." id="search_btn_history">
				</div>
			</form>



			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">From Branch</th>
						<th class="text-center">To</th>
						<th class="text-center">Date Request</th>
						<th class="text-center">Status</th>

					</tr>
				</thead>
				<tbody id="tbody">

					<?php foreach ($process->history_transfer() as $request ) : ?>
						<tr>
							<td class="text-center"><?php echo $request->from_branch ?></td>
							<td class="text-center"><?php echo $request->to_branch ?></td>
							<td class="text-center"><?php echo $request->created_at ?></td>

							<td class="text-center">
								<?php echo $request->status == '1' ? ' <a href="#" class="btn btn-success">Approved</a> ' : '<a href="#" class="btn btn-danger">Pending</a> ' ?>
								
							</td>
						</tr>
					<?php endforeach ?> 


				</tbody>
				<tbody id="tbody_response"></tbody>
			</table>

			
			<?php else : ?>
				<?php setMessage('No Data Transaction Found' , 'success'); ?>

			<?php endif ?>


			

		
	</div>
	<?php endif ?>




<?php require_once 'assets/footer.php' ?>