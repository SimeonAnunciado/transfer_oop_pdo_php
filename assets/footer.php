
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<script>
			
		$('#search_btn').on('keyup', function(){
			let search_value = $(this).val();
			

			if (search_value != '') {
				$('#tbody').hide();
				$('#tbody_response').show();
				$.ajax({
					url : 'inc/process.php',
					type : 'POST',
					data : {search_isset : 1 ,  search_value : search_value }

				})
				.done( data => {
					$('#tbody_response').html(data);
				})
				.fail( err => console.log(err))

			}else{
				$('#tbody').show();
				$('#tbody_response').hide();


			}

		})

		$('#search_btn_history').on('keyup', function (){
			let search_value = $(this).val();

			if (search_value != '') {
				$('#tbody').hide();
				$('#tbody_response').show();
				$.ajax({
					url : 'inc/process.php',
					type : 'POST',
					data : {search_isset_history : 1 ,  search_value : search_value }

				})
				.done( data => {
					$('#tbody_response').html(data);
				})
				.fail( err => console.log(err))

			}else{
				$('#tbody').show();
				$('#tbody_response').hide();


			}


			
		})

		$('.decline_request').on('click', (e) => {
			e.preventDefault();
			const id = $('.decline_request').attr('alt');
			alert(id);
		})
		$('.approve_request').on('click', (e) => {
			e.preventDefault();
			const id = $('.approve_request').attr('alt');

			$.ajax({
				url:'inc/process.php',
				type:'POST',
				data:{approve_isset : 1 , id : id}
			})
			.done( data => {
				alert(data);
				location.reload();
			})
			.fail( err => console.log(err));
		})

		$('#transfer_').on('click',function(e){
			e.preventDefault();
			$.ajax({
				url:'inc/process.php',
				type:'POST',
				data:{transfer : 1}
			})
			.done(data => console.log(data))
			.fail(err => alert(err))
		})

	</script>
</body>
</html>