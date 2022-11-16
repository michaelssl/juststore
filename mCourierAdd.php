<?php 
  include 'db.php';
  session_start();
    
    //validasi role (staff and admin only)
    if(!isset($_SESSION['member'])){//jika belum login
      header("location:index.php");
    }
    else{//sudah login
      //jika member
      if($_SESSION['member']['role_member']!== 'staff' AND $_SESSION['member']['role_member']!== 'admin'){
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
  <title>Add Courier</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Add Courier</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Courier Name" name="name" required>
            </div>
            <div class="form-group">
              <label for="cost">Cost</label>
              <input type="text" id="cost" class="form-control" placeholder="Min Rp.5000 " name="cost" required>
            </div>
            <div class="form-group">
              <label for="image">Courier Icon</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary" name="add">Add Courier</button>
          </form>

          <!-- Logic php -->
          <?php 
            if(isset($_POST['add'])){
              //ambil data
              $nama_courier= $_POST['name'];
              $cost = $_POST['cost'];
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];

              if(strlen($nama_courier) < 3){
                echo "<script>alert('nama minimal 3 huruf');</script>";
              }
              else if($cost < 5000){
                echo "<script>alert('cost minimal Rp.5.000');</script>";
              }
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png' AND $extensionImg !== 'gif' AND $extensionImg !== 'svg'){
                echo "<script>alert('extension file harus jpg, jpeg, png, gif, svg atau file tidak boleh kosong');</script>";
              }
              else if($sizeImg > 2000000){
                echo "<script>alert('max ukuran file 2mb');</script>";
              }
              else{//valid
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name;

                //dapatkan waktu nya
                $hour=date('H');
                $gmt7 =$hour+6; //GMT +7
                $time = date('Y-m-d '). $gmt7 .date(':i:s');
                //pindah file yg diupload
                move_uploaded_file($location,"assets/image_courier/$image_file");
                //masukan ke database
                $insert = $conn->query("INSERT INTO courier(name_courier,price_courier,image_courier,date_update_courier) VALUES('$nama_courier','$cost','$image_file','$time')");
                
                if($insert){
                  echo "<script>alert('Courier berhasil di tambahkan');</script>";
                  echo "<script>location='mcourier.php';</script>";
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