<?php include 'db.php'; 
  session_start();

  if(isset($_COOKIE['login'])){
    $id=$_COOKIE['login'];
    $row_member=$conn->query("SELECT * FROM member WHERE id_member='$id'");
    $data_member= $row_member->fetch_assoc();
    $_SESSION['member']=$data_member;
  }

  if(isset($_SESSION['member'])){//jika sudah login
    header("location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Login</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <h1>JustStore</h1>
        <div class="card">
          
          <div class="card-header">
            
            <h4>Login</h4>
            <p>Don't Have JustStore Account?
              <a href="register.php">Register</a>
            </p>
            <a href="index.php">back</a>
          </div>
          <div class="card-body">


          <form method="post">
            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." required>
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input type="password" id="password" class="form-control" placeholder="password..." name="password" required>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
              <label class="form-check-label" for="rememberme">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary" name="login">Login</button>
          </form>
          <a href="forget.php">Forget Password</a>

          <?php  
          
          if(isset($_POST['login'])){
            //ambil data
            $email = $_POST['email'];
            $password= $_POST['password'];
            $password= md5($password);
            $result = $conn->query("SELECT * FROM member WHERE email_member = '$email' AND password_member = '$password'");

            //cek data
            if($result->num_rows == 1){
              $_SESSION['member']=$result->fetch_assoc();

              if(isset($_POST['rememberme'])){
                //cookie
                $id_member = $_SESSION['member']['id_member'];
                setcookie('login',$id_member, time()+3600); //1jam
              }

              echo "<script>alert('Login Sukses');</script>";
              echo "<script>location='index.php';</script>";
            }
            else{
              echo "<script>alert('Email atau Password anda salah');</script>";
            }

          }
          ?>




          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>
</html>

