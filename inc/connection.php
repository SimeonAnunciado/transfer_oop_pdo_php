<?php 
session_start();


class Process {

	public $con = null;

	public function __construct(){
		$this->db_connection();

		date_default_timezone_set('Asia/Manila');


	}





	public function db_connection(){

		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'store';
		$dsn = "mysql:host={$servername}; dbname={$database}";



		try {
			$this->con = new PDO($dsn,$username,$password);
		} catch (Exception $e) {
			die('connection error ' . $e->getMessage());
		}
	}

	public function display_error($stmt){

		return die($stmt->errorInfo()[2]);

	}


	public function login(){
		if (isset($_POST['login_submit'])) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$stmt = $this->con->prepare("SELECT * FROM administrator WHERE username = :username  ");
			$stmt->execute(['username' => $username ]) or $this->display_error($stmt);
			$user = $stmt->fetch(PDO::FETCH_OBJ);

			$hashed_pass = $user->password;

			if (password_verify($password,$hashed_pass)) {
				$_SESSION['user_id'] = $user->id;
				$_SESSION['user_name'] = $user->username;
				$_SESSION['user_branch'] = $user->branch;
				header('location:index.php');
			}else{
				setMessage('username / password incorrect','danger');
			}

		}
	}

	public function product_entry(){
		if (isset($_POST['product_entry_submit'])) {	
			
			$product_code =   Date('Y') . rand(0,999) .   Date('d');
			$product_name = trim($_POST['product_name']);
			$product_description = trim($_POST['product_description']);
			$product_qtty = trim($_POST['product_qtty']);
			$product_srp = trim($_POST['product_srp']);
			$admin_branch = $_SESSION['user_branch'];

			if ($this->check_if_exists($product_name)) {
				// return product name is exist in database
				setMessage('It seems that this product is already exist in our database..','danger');
			}else{
				$sql = "INSERT INTO products (product_code,product_name,product_description,product_qtty,product_srp,product_branch) 
				VALUES (?,?,?,?,?,?) "; 
				$stmt = $this->con->prepare($sql);
				$result = $stmt->execute([$product_code,$product_name,$product_description,$product_qtty,$product_srp,$admin_branch]) or $this->display_error($stmt);;

				if ($result) {
					setMessage('Success Added New Product','success');
				}else{
					setMessage('Error in Adding New Product','danger');
				}

			}
		}
	}

	public function check_if_exists($product_name){
		$stmt = $this->con->prepare("SELECT product_name FROM products WHERE product_name = ? ");
		$stmt->execute([$product_name]) or $this->display_error($stmt);;
		$count = $stmt->rowCount();
		if ($count > 0 ) {
			return true;
		}else{
			return false;
		}

	}

	public function select_all_products(){
		$stmt = $this->con->prepare("SELECT * FROM products WHERE product_branch = ? ");
		$stmt->execute([$_SESSION['user_branch']]) or $this->display_error($stmt);
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	public function check_if_have_data(){

		$stmt = $this->con->prepare("SELECT * FROM products WHERE product_branch = ? ");
		$stmt->execute([$_SESSION['user_branch']]) or $this->display_error($stmt);
		if ($stmt->rowCount() > 0 )  {
			return true;
		}else{
			return false;
		}
	
	}

	public function get_single_product($id){
		$stmt = $this->con->prepare("SELECT * FROM products WHERE id = ? ");
		$stmt->execute([$id]) or $this->display_error($stmt);
		$product = $stmt->fetch(PDO::FETCH_OBJ);
		return $product;
	}

	public function all_product_id(){
		$product_id = array();
		foreach ($this->select_all_products()  as $key => $product) {
			  $product_id[] = $product->id;
		};
		return $product_id;
	}

	public function update_product(){
		if (isset($_POST['update_entry_submit'])) {

			$hidden_id = trim($_POST['product_id_hidden']);
			$product_name = trim($_POST['product_name']);
			$product_description = trim($_POST['product_description']);
			$product_qtty = trim($_POST['product_qtty']);
			$product_srp = trim($_POST['product_srp']);
			$admin_branch = $_SESSION['user_branch'];

			$sql = "UPDATE products SET product_name = ? , product_description = ? , product_qtty = ? , product_srp = ? , product_branch = ? WHERE id = ?  ";
			$stmt = $this->con->prepare($sql);
			$result = $stmt->execute([$product_name,$product_description,$product_qtty,$product_srp,$admin_branch,$hidden_id]) or $this->display_error($stmt);
			
			if ($result) {
				setMessage('Success Update Product','success');
			}else{
				setMessage('Error in Update Product','danger');
			}

		}
	}

	public function select_all_branches(){
		$stmt = $this->con->prepare("SELECT * FROM store_branch");
		$stmt->execute() or $this->display_error($stmt);
		$results = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $results;
	}

	public function transfer_product(){
		if (isset($_POST['transfer_submit'])) {

	
			 $hidden_code = trim($_POST['product_code_hidden']);
			 $from_branch_name = trim($_SESSION['user_branch']);
			 $to_branch = trim($_POST['branch_name']);
			 $status = '0';

			 if ($this->check_is_transfer_request_exists($hidden_code,$from_branch_name,$to_branch)) {
				setMessage('It seems that this Request are already sent plaese wait for transfer approval','danger');
			 }else{
			 	$sql = "INSERT INTO transfer_transaction (product_code,from_branch,to_branch,status) VALUES (?,?,?,?)  ";
			 	$stmt = $this->con->prepare($sql);
			 	$result = $stmt->execute([$hidden_code,$from_branch_name,$to_branch,$status]) or $this->display_error($stmt);

			 	if ($result) {
			 		setMessage('Transfer Request Sent ','success');
			 	}else{
			 		setMessage('Transfer Request Error','danger');
			 	}

			 }

	

		}
	}

	public function check_is_transfer_request_exists($hidden_code,$from_branch_name,$to_branch){
		$sql = "SELECT product_id FROM transfer_transaction WHERE product_code = ? AND from_branch = ? AND to_branch = ?  ";
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$hidden_code,$from_branch_name,$to_branch]) or $this->display_error($stmt);
		$count = $stmt->rowCount();

		if ($count > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	public function requesting_transfer(){
		$status = '0';
		$sql = "SELECT * FROM transfer_transaction WHERE to_branch = ? AND status = ?   ";
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$_SESSION['user_branch'], $status ]  );
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	public function approved_request($product_code){
		$status = '1';

		$stmt = $this->con->prepare("UPDATE transfer_transaction SET status = ? WHERE product_code = ?  ");
		$result = $stmt->execute([$status,$product_code]) or $this->display_error($stmt);

		$stmt_a = $this->con->prepare("UPDATE products SET product_branch = ? WHERE product_code = ? ");
		$result1 = $stmt_a->execute([$_SESSION['user_branch'],$product_code]);


	if($result  AND $result1 ){
		echo 'Approved Request Success';
	}else{
		echo 'Approved Request Error';
	}



} 



	public function check_if_have_data_request_transfer(){
		$status = '0';
		$sql = "SELECT * FROM transfer_transaction WHERE to_branch = ? AND status = ?   ";
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$_SESSION['user_branch'], $status ]  ) or $this->display_error($stmt);
		if($stmt->rowCount() > 0 ){
			return true;
		}else{
			return false;
		}
		
	}
	



	public function history_transfer(){
	
		$sql = "SELECT * FROM transfer_transaction WHERE from_branch = ?  ";
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$_SESSION['user_branch'] ]) or $this->display_error($stmt);
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $result;
		




		
	}

	public function check_if_have_data_history_transfer(){
		$status = '0';
		$sql = "SELECT * FROM transfer_transaction WHERE from_branch = ?   ";
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$_SESSION['user_branch']] ) or $this->display_error($stmt);
		if($stmt->rowCount() > 0 ){
			return true;
		}else{
			return false;
		}
		
	}

	public function search($search_value){

		if($this->check_if_search_found($search_value)){

			$stmt = $this->con->prepare("SELECT * FROM products WHERE product_branch = ? AND product_code LIKE ? ||  product_name LIKE  ? || product_description LIKE ?  ||  product_branch LIKE ?");
			$stmt->execute([$_SESSION['user_branch'],'%' .$search_value. '%','%' .$search_value. '%','%' .$search_value. '%','%' .$search_value. '%']) or $this->display_error($stmt);
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);



			foreach ($results as $key => $result) {
				$product_id_link = password_hash($result->id , PASSWORD_DEFAULT) . ';' . $result->id .';'. password_hash($result->id , PASSWORD_DEFAULT);
				?>
				<tr>
					<td><?php echo $result->product_code ?></td>
					<td><?php echo $result->product_name ?></td>
					<td><?php echo $result->product_description ?></td>
					<td><?php echo $result->product_qtty ?></td>
					<td><?php echo $result->product_srp ?></td>
					<td><?php echo $result->product_branch ?></td>
					<td><?php echo $result->created_at ?></td>

					<td class="text-center">
						<a href="transfer.php?id=<?php echo $product_id_link ?> " class="btn btn-warning">Transfer</a>&nbsp;
						<a href="view.php?id=<?php echo $product_id_link ?> " class="btn btn-success">View</a>
					</td>
				</tr>

				<?php
			}

		}else{
			?>
			<tr>
				<td colspan="100" align="center">No Data Found</td>
			</tr>
			<?php

		}


	}


	public function search_history($search_value){

		if($this->check_if_search_found($search_value)){

			$stmt = $this->con->prepare("SELECT * FROM transfer_transaction WHERE from_branch = ? AND  to_branch LIKE  ?   ");
			$stmt->execute([ $_SESSION['user_branch'], '%' .$search_value. '%' ]) or $this->display_error($stmt);
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);



			foreach ($results as $key => $result) {
				$product_id_link = password_hash($result->id , PASSWORD_DEFAULT) . ';' . $result->id .';'. password_hash($result->id , PASSWORD_DEFAULT);
				?>
				<tr>
					<td class="text-center"><?php echo $result->from_branch?></td>
					<td class="text-center"><?php echo $result->to_branch ?></td>
					<td class="text-center"><?php echo $result->created_at ?></td>
					<td class="text-center">
						<?php echo $result->status == '1' ? ' <a href="#" class="btn btn-success">Approved</a> ' : '<a href="#" class="btn btn-danger">Pending</a> ' ?>

					</td>
				</tr>

				<?php
			}

		}else{
			?>
			<tr>
				<td colspan="100" align="center">No Data Found</td>
			</tr>
			<?php

		}


	}





	public function check_if_search_found($search_value){
		$stmt = $this->con->prepare("SELECT * FROM products WHERE product_code LIKE ? ||  product_name LIKE  ? || product_description LIKE ?  ||  product_branch LIKE ?  ");
		$stmt->execute(['%' .$search_value. '%','%' .$search_value. '%','%' .$search_value. '%','%' .$search_value. '%']) or $this->display_error($stmt);

		if ($stmt->rowCount() > 0 ) {
			return true;
		}else{
			return false;
		}


	}

	public function count_request(){

		$status = '0';
		$sql = "SELECT count(*) as total_count FROM transfer_transaction WHERE to_branch = ? AND status = ?   ";
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$_SESSION['user_branch'], $status ]  ) or $this->display_error($stmt);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result->total_count;

	}
	public function store_to_temp_tbl($product_id){

		if($this->check_if_exists_temp($product_id)){
				header('location:index.php');
		}else{

			$stmt = $this->con->prepare("INSERT INTO temp_transfer (branch,product_id) VALUES (?,?)");
			$result = $stmt->execute([$_SESSION['user_branch'],$product_id]);

			if ($result) {
				header('location:index.php');
			}else{
				die('something_went wrong');
			}

		}
		
	}

	public function check_if_exists_temp($product_id){
		$stmt = $this->con->prepare("SELECT * FROM temp_transfer WHERE product_id = ?  ");
		$stmt->execute([$product_id]) or $this->display_error($stmt);

		if ($stmt->rowCount() > 0 ) {
			return true;
		}else{
			return false;
		}


	}

	public function processCount(){
		$status= '0';
		$stmt = $this->con->prepare("SELECT count(*) as total FROM temp_transfer WHERE branch = ? AND status = ?  ");
		$stmt->execute([$_SESSION['user_branch'],$status]) or $this->display_error($stmt);

		$result = $stmt->fetch(PDO::FETCH_OBJ);
		echo $result->total;

	}

	public function transfer_process(){
		$status = '1';
		$stmt = $this->con->prepare("UPDATE temp_transfer SET status = ?  ");
		$result = $stmt->execute([$status]) or $this->display_error($stmt);

		$product_details = $this->all_product_id_temp();
		$total = count($this->all_product_id_temp());




	for ($i=0; $i < $total; $i++) { 

		$query = $this->con->prepare("SELECT * FROM products WHERE id = ? "); 
		$query->execute([$product_details[$i]]);
		$results = $query->fetch(PDO::FETCH_OBJ);


		$stmta =$this->con->prepare("INSERT INTO  temp_transfer_details (product_id,product_name,product_description,product_qtty,product_srp) VALUES (?,?,?,?,?)");
		$stmta->execute([$results->id,$results->product_name,$results->product_description, $results->product_qtty,$results->product_srp]);


	}



	}

	public function aa__($id){
		$status = '0';
		$stmta = $this->con->prepare("SELECT * FROM product WHERE id =  ? AND status = ?  ");
		$stmta->execute([$id,$status]);
		$resulta = $stmta->fetchAll(PDO::FETCH_OBJ);
		return $resulta;
		
	}
	public function all_product_id_temp(){
		$status = '0';
		$stmta = $this->con->prepare("SELECT * FROM temp_transfer WHERE branch = ? AND status = ? ");
		$stmta->execute([$_SESSION['user_branch'],$status]);
		$resulta = $stmta->fetchAll(PDO::FETCH_OBJ);
		$all_id = array();
		foreach ($resulta as  $value) {
			$all_id[] = $value->product_id;
		}

		return $all_id;
	}

	public function select_all_to_be_trans(){
		$status = '0';
		$stmta = $this->con->prepare("SELECT * FROM temp_transfer WHERE branch = ? AND status = ? ");
		$stmta->execute([$_SESSION['user_branch'],$status]);
		$resulta = $stmta->fetchAll(PDO::FETCH_OBJ);
		$all_id = array();
		foreach ($resulta as  $value) {
			$all_id[] = $value->product_id;
		}

		return $all_id;
	}

	public function test(){
		
	}

	










}



?>