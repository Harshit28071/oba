<?php 
require_once("../../common/database.php");
$db = new Database();
$conn = $db->connect();
// Receive username and password from POST request
if(isset($_POST['signin'])){
$username = $_POST['username'];
$password = $_POST['password'];
// Hash the received password
//$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// Query the database to check if username and password match
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? LIMIT 1");
$stmt->bind_param("s",$username);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if(count($result) > 0){
 if (password_verify($password, $result[0]['password'])){
        // Username and password match
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $tokenCreationTime = date("Y-m-d H:i:s"); // Current timestamp
        // Store token and creation time in the database
        $insertQuery = "UPDATE  user SET token = ? ,token_creation_time = ? WHERE id = ?";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param('ssi', $token,$tokenCreationTime,$result[0]['id']);
        
        $insertStmt->execute();

        //Send success response to frontend
        echo json_encode(["token" => $token]);
        session_start();
        $_SESSION["s_id"] =$result[0]['id'];
        $_SESSION["s_username"] =$result[0]['username'];
        $_SESSION["s_role"] =$result[0]['role'];
        $_SESSION["s_token"] =$result[0]['token'];
        echo $_SESSION["s_token"];
        $_SESSION["s_username"];

      
    }else {
        // Invalid username or password
        echo json_encode(["error" => "Invalid username or password "]);
        $error = "Invalid Username Password";
    }
  }
else {
  // Username not found
  echo json_encode(["error" => "Invalid username or password"]);
   }
  
// Close the database connection
$stmt->close();


$conn->close();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Harihar  | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../theme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../theme/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" id="loginform">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="signin" name="signin">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../theme/dist/js/adminlte.min.js"></script>
  
</body>
</html>