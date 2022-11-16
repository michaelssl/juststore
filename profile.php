<?php
include 'db.php';

session_start();

if(!isset($_SESSION['member'])){//jika belum login
  header("location:index.php");
}

$member= $_SESSION['member'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>My Profile</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">My Profile</h4>
          <div class="card-body">

          <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <img src="assets/image_profile/<?php echo $member['image_member']; ?>"" alt="profile" width="130px" class="mb-2">
            <a href="changeimg.php"  class="mb-2 btn btn-secondary">change picture</a>
            </div>
          </div>


          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Name..." name="name" required 
              value="<?php echo $member['name_member']  ?>">
            </div>

            <div class="form-group">  
              <label for="gender">Gender</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input ml-4" type="radio" name="gender" id="male" value="Male" required <?php if($member['gender_member']== 'Male') echo "checked"; ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if($member['gender_member']== 'Female') echo "checked"; ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="adress.." required><?php echo $member['address_member'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone..." required
              value="<?php echo $member['phone_member']  ?>">
            </div>

            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." required
              value="<?php 
              echo $member['email_member'];  
              if($member['verified']==1){
                echo "        (email telah terverifikasi)";
              }
              else{
                echo "        (email belum terverifikasi)";
              }

              ?>" disabled>
            </div>

            <button type="submit" class="btn btn-primary" name="update">Update</button>
          </form>
          <a href="changepass.php" class="btn btn-info mt-2">Change Password</a>

          <?php 
            if(isset($_POST['update'])){
              $name =$_POST['name'];
              $gender =$_POST['gender'];
              $address = $_POST['address'];
              $phone =$_POST['phone'];
              $id_member = $member['id_member'];
              $email_member = $member['email_member'];


              //validasi
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
                              WHERE id_member = '$id_member'
                            ");

                        if($update){
                          $data_member = $conn->query("SELECT * FROM member WHERE email_member ='$email_member' ");
                          if($data_member->num_rows == 1){
                            $_SESSION['member']= $data_member->fetch_assoc();
                          }else{
                            echo $conn->error;
                          }

                          echo "<script>alert('Profile berhasil di update');</script>";
                          echo "<script>location='index.php';</script>";
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