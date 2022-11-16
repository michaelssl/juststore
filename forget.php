<?php include 'db.php'; 
  session_start();
  
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
  <title>Forget Password</title>
</head>
<body>
<?php include 'navbar.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <h1>JustStore</h1>
        <div class="card">
            <h4 class="card-header">Forget Password</h4>
          <div class="card-body">
          <div class="alert alert-primary" role="alert">
            <p><strong>Please Enter your registered email ID</strong></p>
            <hr>
            <p>We will send a new password to your registered email</p>
          </div>

          <form method="post">
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." required>
            </div>
            <button type="submit" class="btn btn-primary" name="reset">Reset Password</button>
          </form>

          <?php 
            if(isset($_POST['reset'])){
              $email = $_POST['email'];

              $result = $conn->query("SELECT * FROM member WHERE email_member = '$email' ");

              if($result->num_rows == 1){
                $data_member= $result->fetch_assoc();
                $password_lama=$data_member['password_member'];
                //rumus mendapatkan password baru
                $len=strlen($password_lama)/1.5;
                $password_baru = substr($password_lama,$len);
                $password_baru_enkripsi = md5($password_baru);

                $update= $conn->query("UPDATE member SET password_member = '$password_baru_enkripsi' WHERE email_member = '$email'");

                if($update){
                  $to= $email;
                  $subject= "Reset Password";
                  $message = "<p>Hi!<strong> ";
                  $message .= $data_member['name_member'];
                  $message .="</strong></p><br>";
                  $message .="<p>Here is your new password: ";
                  $message .= $password_baru;
                  $message .= "</p><br>";
                  $message .= "<p>DO NOT SHARE YOUR PASSWORD</p>";
                  $message .=" <a href='http://localhost/AMDP3ITDIV/AMDP3_2301876000_Michael%20Susilo/index.php'>Login and Change Password!</a>";

                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                  $headers .= 'From: <phpsender123@gmail.com>' . "\r\n";
                  $sendtomail = mail($to, $subject, $message, $headers);
                  if( $sendtomail ){
                    echo "<script>alert('Password baru telah dikirimkan ke email anda, Silahkan periksa email anda');</script>";
                    echo "<script>location='index.php';</script>";
                    
                  }
                  else echo "<script>alert('terjadi kesalahan');</script>";
                }
                else{
                  echo $conn->error;
                }
              }
              else{
                echo "<script>alert('Email tidak terdaftar!'); </script>";
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

