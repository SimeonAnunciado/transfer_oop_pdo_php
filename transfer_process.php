<?php require_once 'assets/header.php'; ?>
	

	<?php if (isLoggedIn()) : ?>
	<div class="container">
		<a href="index.php" class="btn btn-primary">Go Back</a>
		<br><br>
		<a href="transfer_process.php" class="btn btn-primary ">Transfer Process <span class="badge"><?php $process->processCount(); ?></span></a>
		<br><br>

		<?php if( $process->check_if_have_data()) : ?>

		

		
			
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
				<?php $process->test()  ?>

			</tbody>
			<tbody id="tbody_response"></tbody>
		</table>

		<a href="#" class="btn btn-default btn-block" id="transfer_">Transfer</a>

		<?php else: ?>
			<?php setMessage('No Data Found' , 'success'); ?>

		<?php endif ?>




	</div>
	<?php endif ?>




<?php require_once 'assets/footer.php' ?>