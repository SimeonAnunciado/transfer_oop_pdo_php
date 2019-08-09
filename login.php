<?php require_once 'assets/header.php'; ?>


	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">

				<div class="panel panel-default" style="margin-top: 100px;">
					<div class="panel-heading">Administrator Login</div>
					<div class="panel-body">
						<?php $process->login(); ?>
						<form class="form-horizontal" action="#" method="POST">
							<div class="form-group">
								<label class="control-label col-sm-2" for="username">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password:</label>
								<div class="col-sm-10">          
									<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
								</div>
							</div>

							<div class="form-group">        
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" name="login_submit" class="btn btn-default btn-block" value="LOGIN">
								</div>
							</div>
						</form>

					</div>
				</div>

				
			</div>
			<div class="col-md-3"></div>
		</div>
		
		
	</div>
<?php require_once 'assets/footer.php'; ?>