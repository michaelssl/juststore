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
          <?php 
            $id_staffadmin=$_GET['id'];
            $result= $conn->query("SELECT * FROM member WHERE id_member = $id_staffadmin");
            $data= $result->fetch_assoc();
          ?>
  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header"><?php echo $data['role_member'] ?> Information</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Name..." name="name" required
              value="<?php echo $data['name_member']; ?>">
            </div>

            <div class="form-group">  
              <label for="gender">Gender</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input ml-4" type="radio" name="gender" id="male" value="Male" required <?php if($data['gender_member']== 'Male') echo "checked"; ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if($data['gender_member']== 'Female') echo "checked"; ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="adress.." required><?php echo $data['address_member']; ?></textarea>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone..." required
              value="<?php echo $data['phone_member']; ?>">
            </div>

            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." required
              value="<?php echo $data['email_member']; ?>" disabled>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" class="form-control" placeholder="password..." name="password">
            </div>

            <div class="form-group">
              <label for="password2">Re-password</label>
              <input type="password" id="password2" class="form-control" placeholder="confirm password" name="password2">
            </div>

            <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
          </form>

          <!-- php logic -->
          <?php 
            if(isset($_POST['save'])){
              $name =$_POST['name'];
              $gender =$_POST['gender'];
              $address = $_POST['address'];
              $phone =$_POST['phone'];
              $password_new=$_POST['password'];
              $password_new2=$_POST['password2'];

              if($password_new == '' AND $password_new2 ==''){//jikas password kosong
                if(strlen($name) < 3){
                  echo "<script>alert('nama minimal 3 huruf');</script>";
                }
                else if(strlen($address) < 10){
                  echo "<script>alert('address minimal 10 huruf');</script>";
                }
                else if(strlen($phone) < 10 OR !is_numeric($phone)){
                  echo "<script>alert('phone minimal 10 angka atau harus angka');</script>";
                }
                else{//valid
                  $update= $conn->query("UPDATE member SET
                                name_member = '$name',
                                gender_member= '$gender',
                                address_member= '$address',
                                phone_member = '$phone'
                                WHERE id_member = '$id_staffadmin'
                              ");
  
                      if($update){
                          echo "<script>alert('perubahan berhasil disimpan');</script>";
                          echo "<script>location='mstaffadmin.php';</script>";
                      }
                      else{
                        echo $conn->error;
                      }
                }
              }
              else{//password tidak kosong
                if(strlen($name) < 3){
                  echo "<script>alert('nama minimal 3 huruf');</script>";
                }
                else if(strlen($address) < 10){
                  echo "<script>alert('address minimal 10 huruf');</script>";
                }
                else if(strlen($phone) < 10 OR !is_numeric($phone)){
                  echo "<script>alert('phone minimal 10 angka atau harus angka');</script>";
                }
                else if($password_new != $password_new2 OR strlen($password_new) < 6){
                  echo "<script>alert('password baru tidak sama!');</script>";
                }
                else{//valid
                  $password_new_enkripsi = md5($password_new);


                  $update= $conn->query("UPDATE member SET
                                name_member = '$name',
                                gender_member= '$gender',
                                address_member= '$address',
                                phone_member = '$phone',
                                password_member= '$password_new_enkripsi'
                                WHERE id_member = '$id_staffadmin'
                              ");
  
                      if($update){
                          echo "<script>alert('perubahan berhasil disimpan');</script>";
                          echo "<script>location='mstaffadmin.php';</script>";
                      }
                      else{
                        echo $conn->error;
                      }
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