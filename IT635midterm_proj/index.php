

<!DOCTYPE html>
<?php
$localhost = 'localhost';
$username ='ashim';
$password ='ashim1';
$dbname = 'wholesale';


// db connection
$con = mysqli_connect($localhost,$username,$password,$dbname);

session_start();



if(isset($_SESSION['user_Id'])) {
	header ('dashboard.php');	
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $mysqli_connect($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $mysqli_connect($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['user_Id'] = $user_id;

				header('dashboard.php');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} 
		} else {		
			$errors[] = "Username doesnot exists";		
		} 
	} 
	
} 

?>
<html>
<head>
	<title>Wholesale Management System</title>
	<!-- bootstrap -->
	
	<link rel="stylesheet" Type='text/css' href='assets/bootstrap/css/bootstrap.min.css'>
	<!-- bootstrap theme-->
	
	<link rel="stylesheet" Type='text/css' href="assets/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->

	<link rel="stylesheet" Type='text/css' href="assets/font/css/font-awesome.min.css">
	<!-- custom css -->

  	<link rel="stylesheet" Type='text/css' href="custom/css/custom.css">	
	<!-- jquery -->

	<script src="assets/jquery/jquery.min.js"></script>
  	<!-- jquery ui -->  

  	<link rel="stylesheet" Type='text/css' href="assets/jquery-ui/jquery-ui.min.css">
  	<script Type='text/javascript' src="assets/jquery-ui/jquery-ui.min.js"></script>
	<!-- bootstrap js -->

	<script Type='text/javascript' src="assets/bootstrap/js/bootstrap.min.js"></script>
	</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign in</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php 

if($errors) {
		foreach ($errors as $key => $value) {
		"<div class='alert alert-warning' role='alert'>
		<i class='glyphicon glyphicon-exclamation-sign'></i>
</div>"										
		}
} 

?>
						</div>

						<form class="form-horizontal" action="dashboard.php" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
 <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<!-- container -->	
</body>
</html>

