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
  <title>Edit Category</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Edit Category</h4>
          <div class="card-body">

          <?php
            $id_category=$_GET['id'];
            $result=$conn->query("SELECT * FROM category WHERE id_category='$id_category'");
            $data=$result->fetch_assoc();
          ?>

          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="id">ID</label>
              <input type="text" id="id" class="form-control" placeholder="category id" name="id" disabled
              value="<?php echo $data['id_category']; ?>">
            </div>

          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="category Name" name="name" required value="<?php echo $data['name_category'];  ?>">
            </div>
            <div class="form-group">
              <label for="image">Category Icon</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
              <label for="cost">Last Updated:      <?php echo $data['date_update_category'] ?></label>
            </div>
            <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
          </form>

          <!-- logic php -->
          <?php 
            if(isset($_POST['save'])){
              $name=$_POST['name'];
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];

              if(strlen($name) < 3){
                echo "<script>alert('nama minimal 3 huruf');</script>";
              }
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png' AND $extensionImg !== 'gif' AND $extensionImg !== 'svg' AND $extensionImg !== ''){
                echo "<script>alert('extension file harus jpg, jpeg, png, gif, svg');</script>";
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
                $image_name_old= $data['image_category'];

                if(!empty($location)){//jika filenya tidak kosong / ada file
                  //hapus file lama
                  if(file_exists("assets/image_category/$image_name_old")){                  
                    unlink("assets/image_category/$image_name_old");       
                  }
                  //masukan file baru
                  move_uploaded_file($location,"assets/image_category/$image_file");

                  //update db
                  $update= $conn->query("UPDATE category SET name_category='$name',
                  image_category='$image_file',date_update_category='$time' WHERE id_category = $id_category");
                  

                }
                else{//file tidak ada
                  //update db tanpa foto baru
                  $update= $conn->query("UPDATE category SET name_category='$name',
                  date_update_category='$time' WHERE id_category = $id_category");
                }

                if($update){
                  echo "<script>alert('category berhasil di ubah!');</script>";
                  echo "<script>location='mcategory.php';</script>";
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