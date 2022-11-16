<?php 
  include 'db.php';
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
  <title>Register</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Change Profile Picture</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="image">Profile Picture</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary" name="changeimg">Change Picture</button>
          </form>

          <?php 
            $id_member= $_SESSION['member']['id_member'];
            if(isset($_POST['changeimg'])){
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];

              //validasi
              if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png'){
                echo "<script>alert('extension file harus jpg, jpeg, png');</script>";
              }
              else if($sizeImg > 2000000){
                echo "<script>alert('max ukuran file 2mb');</script>";
              }
              else{//valid
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name;
                $image_name_old = $_SESSION['member']['image_member'];
                if(!empty($location)){//jika filenya tidak kosong / ada file
                  
                  //validasi foto, jika bukan foto default hps file fotonya yg lama
                  if($image_name_old !== 'profile_default.png' AND file_exists("assets/image_profile/$image_name_old")){                  
                      unlink("assets/image_profile/$image_name_old");       
                  }

                  //masukan file dan update db
                  move_uploaded_file($location,"assets/image_profile/$image_file");
                  $update= $conn->query("UPDATE member SET image_member = '$image_file' WHERE id_member = '$id_member'");

                  //masukan data yg telah diupdate ke session
                  $result= $conn->query("SELECT * FROM member WHERE id_member= '$id_member'");
                  if($result->num_rows == 1){
                    $_SESSION['member']=$result->fetch_assoc();
                  }
                  else{
                    $conn->error;
                  }


                  echo "<script>alert('profile picture berhasil di update!');</script>";
                  echo "<script>location='index.php';</script>";                  
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