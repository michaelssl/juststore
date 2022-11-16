<?php 
include 'db.php';
session_start();
  
  //validasi role (admin only)
  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }
  else{//sudah login
    
    if($_SESSION['member']['role_member']!== 'admin'){
      header("location:index.php");
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Add Staff/Admin</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Add Staff/Admin</h4>
          <div class="card-body">
          <a href="mstaffadminadd.php" class="btn btn-danger mr-2">X</a>
          <a href="mstaffadminadd.php?page=newacc" class="btn btn-info">New Account</a>
          <a href="mstaffadminadd.php?page=uprole" class="btn btn-info ml-2">Update Role</a>
          
          <?php 
            if(isset($_GET['page'])){
              if($_GET['page']=="newacc"){
                include 'StaffAdminAdd/newacc.php';
              }
              else if($_GET['page']=="uprole"){
                include 'StaffAdminAdd/uprole.php';
              }
            }
          ?>

          <!-- php logic -->

          <!-- Update Role -->
          <?php 
            if(isset($_POST['uprole'])){
              $role = $_POST['role'];
              $email = $_POST['email'];

              $result_uprole = $conn->query("SELECT * FROM member WHERE email_member = '$email'");

              if($result_uprole->num_rows == 1){
                
                $update=$conn->query("UPDATE member SET role_member='$role', verified='1' WHERE email_member='$email'");
                if($update){
                  echo "<script>alert('Role telah di update'); </script>";
                  echo "<script>location='mstaffadmin.php';</script>";
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
          <!-- Jika New Account -->
          <?php 
            if(isset($_POST['newacc'])){
              $role = $_POST['role'];
              $name = $_POST['name'];
              $gender = $_POST['gender'];
              $address = $_POST['address'];
              $phone = $_POST['phone'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $password2 = $_POST['password2'];

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
              else{//valid
                $password = md5($password);

                $insert = $conn->query("INSERT INTO member(name_member,gender_member,address_member,phone_member,email_member,password_member,role_member,verified)
                  VALUES('$name','$gender','$address','$phone','$email','$password','$role','1')");
              
                if($insert){
                  echo "<script>alert('Akun baru dengan role ".$role ;
                  echo " telah di tambahkan');</script>";
                  echo "<script>location='mstaffadmin.php';</script>"; 
                }
                else{
                  $conn->error;
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