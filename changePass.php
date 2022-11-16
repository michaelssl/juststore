<?php include 'db.php'; 
  session_start();


  if(!isset($_SESSION['member'])){//jika belum login
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
<?php include 'navbar.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <h1>JustStore</h1>
        <div class="card">
          
          <div class="card-header">
            <h4>Change Password</h4>
          </div>
          <div class="card-body">


          <form method="post">
          <div class="form-group">
              <label for="password_old">Current Password</label>
              <input type="password" id="password_old" class="form-control" placeholder="current password" name="password_old" required>
            </div>
            <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" id="password" class="form-control" placeholder="new password" name="password" required>
            </div>
            <div class="form-group">
              <label for="password2">Confirm Password</label>
              <input type="password" id="password2" class="form-control" placeholder="confirm password" name="password2" required>
            </div>

            <button type="submit" class="btn btn-primary" name="changepass">Change Password</button>
          </form>

          <?php 
          if(isset($_POST['changepass'])){
            $password_old = $_POST['password_old'];
            $password_new = $_POST['password'];
            $password_new2= $_POST['password2'];

            $password_old=md5($password_old);

            $id_member= $_SESSION['member']['id_member'];
            $result= $conn->query("SELECT * FROM member WHERE id_member = '$id_member' AND password_member ='$password_old'");

            if($result->num_rows == 1){
              if($password_new != $password_new2 OR strlen($password_new) < 6){
                echo "<script>alert('password baru tidak sama!');</script>";
              }
              else{//valid
                $password_new_enkripsi = md5($password_new);
                $update = $conn->query("UPDATE member SET password_member = '$password_new_enkripsi' WHERE id_member = '$id_member' AND password_member ='$password_old'");

                if($update){
                  echo "<script>alert('password berhasil diubah');</script>";
                  echo "<script>location='index.php';</script>";
                }
                else{
                  echo $conn->error;
                }
              }

            }
            else{
              echo "<script>alert('password salah');</script>";
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

