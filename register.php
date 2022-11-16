<?php 
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
  <title>Register</title>
</head>
<body>


  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Register</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Name..." name="name" required>
            </div>

            <div class="form-group">
              <label for="gender">Gender</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input ml-4" type="radio" name="gender" id="male" value="Male" required>
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
              <label class="form-check-label" for="female">Female</label>
            </div>
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="adress.." required></textarea>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone..." required>
            </div>

            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." required>
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input type="password" id="password" class="form-control" placeholder="password..." name="password" required>
            </div>

            <div class="form-group">
              <label for="password2">Re-password</label>
              <input type="password" id="password2" class="form-control" placeholder="confirm password" name="password2" required>
            </div>

            <div class="form-group">
              <label for="image">Profile Picture</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary" name="register">Register</button>
          </form>

          <!-- logic php -->
          <?php 
            include 'db.php';
            if(isset($_POST['register'])){
              //ambil data
              $name = $_POST['name'];
              $gender = $_POST['gender'];
              $address = $_POST['address'];
              $phone = $_POST['phone'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $password2 = $_POST['password2'];
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];

              $result= $conn->query("SELECT * FROM member WHERE email_member = '$email'");

              if(strlen($name) < 3){
                echo "<script>alert('nama minimal 3 huruf');</script>";
              }
              else if(strlen($address) < 10){
                echo "<script>alert('address minimal 10 huruf');</script>";
              }
              else if(strlen($phone) < 10 OR !is_numeric($phone)){
                echo "<script>alert('phone minimal 10 angka atau harus angka');</script>";
              }
              else if($result->num_rows == 1){
                echo "<script>alert('email sudah terdaftar');</script>";
              }
              else if($password != $password2 OR strlen($password) < 6){
                echo "<script>alert('password tidak sama! atau min 6 karakter');</script>";
              }
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png' AND $extensionImg !== ''){
                echo "<script>alert('extension file harus jpg, jpeg, png');</script>";
              }
              else if($sizeImg > 2000000){
                echo "<script>alert('max ukuran file 2mb');</script>";
              }
              else{ //valid
                
                $vkey = md5(time(). $email);
                $password = md5($password);
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name; //di dpn nama file di beri tgl/waktu agar file tidak ke replace

                if(!empty($location)){//jika filenya tidak kosong / ada file
                  
                  move_uploaded_file($location,"assets/image_profile/$image_file");
                  
                  $insert = $conn->query("INSERT INTO member(name_member,gender_member,address_member,phone_member,email_member,password_member,role_member,vkey,image_member)
                  VALUES('$name','$gender','$address','$phone','$email','$password','member','$vkey','$image_file')");
                }
                else{
                  $insert = $conn->query("INSERT INTO member(name_member,gender_member,address_member,phone_member,email_member,password_member,role_member,vkey)
                  VALUES('$name','$gender','$address','$phone','$email','$password','member','$vkey')");
                }

                

                if($insert){
                  $to= $email;
                  $subject= "Email Verification";
                  $message = "<p>Hi! You've Signed up a JustStore Account</p>";
                  $message .="<p>Please Take a moment to verify that this is your email</p>";
                  $message .=" <a href='http://localhost/AMDP3ITDIV/AMDP3_2301876000_Michael%20Susilo/verify.php?vkey=$vkey'>Verify My Email Address</a>";

                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                  $headers .= 'From: <phpsender123@gmail.com>' . "\r\n";

                  $sendtomail = mail($to, $subject, $message, $headers);
                  if( $sendtomail ){
                    echo "<script>alert('Verification Email telah dikirim, Silahkan periksa email anda');</script>";
                    echo "<script>location='login.php';</script>";
                    
                  }
                  else echo "<script>alert('terjadi kesalahan');</script>";
                }
                else{
                  echo $conn->error;
                }

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