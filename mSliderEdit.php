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
  <title>Add Product</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Edit Slider</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">
          <?php 
            $id_slider = $_GET['id'];
            $result= $conn->query("SELECT * FROM slider WHERE id_slider = '$id_slider'");
            $data = $result->fetch_assoc();
          ?>

          <div class="form-group">
              <label for="id">id</label>
              <input type="text" id="id" class="form-control" placeholder="Slider id" name="id" disabled
              value="<?php echo $data['id_slider']  ?>">
            </div>
            
            <div class="form-group">
              <label for="sequence">Sequence</label>
              <input type="text" id="sequence" class="form-control" placeholder="Sequence: Min 1" name="sequence" required value="<?php echo $data['sequence_slider'];  ?>">
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Slider Name" name="name" required
              value="<?php echo $data['name_slider'];  ?>">
            </div>
            
            <div class="form-group">
              <label for="hyperlink">Hyperlink</label>
              <input type="text" id="hyperlink" class="form-control" placeholder="diawali dengan: http / https / localhost / 127.0.0.1" name="hyperlink" required value="<?php echo $data['hyperlink_slider'];  ?>">
            </div>
            <div class="form-group">
              <label for="date_start">Start At</label>
              <input type="datetime-local" id="date_start" class="form-control" placeholder="..." name="date_start" required value="<?php echo date('Y-m-d\TH:i:s',strtotime($data["date_start_slider"])); ?>">
            </div>
            <div class="form-group">
              <label for="date_end">End At</label>
              <input type="datetime-local" id="date_end" class="form-control" placeholder="..." name="date_end" <?php 
              if($data['date_end_slider']==NULL){
                  
              }else{
                echo "value=" ;
                echo date('Y-m-d\TH:i:s',strtotime($data["date_end_slider"])); 
                echo '"';
              }
              ?> >
            </div>

            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
            
            <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
          </form>

          <?php 
            if(isset($_POST['save'])){
              $name= $_POST['name'];
              $sequence = $_POST['sequence'];//inputan
              $sequence_own =$data['sequence_slider'];//sequence lama atau di db
              $date_start= $_POST['date_start'];
              $date_end = $_POST['date_end'];
              $hyperlink = $_POST['hyperlink'];
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];
              
              $count =stripos($hyperlink,"/");
              $link= substr($hyperlink,0,$count);

              //mengecek sequence
              $seq_query = $conn->query("SELECT * FROM slider WHERE sequence_slider ='$sequence' 
              AND sequence_slider != '$sequence_own' ");

              if(strlen($name) < 5){
                echo "<script>alert('nama slider minimal 5 huruf');</script>";
              }
              else if($sequence < 1 OR $seq_query->num_rows != 0){
                echo "<script>alert('sequence minimal 1 atau sequnce sudah ada');</script>";
              }
              else if($link !== 'https:' AND $link !== 'http:' AND $link !== 'localhost' AND $link !== '127.0.0.1'){
                echo "<script>alert('harus diawali dengan http / https / localhost / 127.0.0.1');</script>";
              }
              else if($date_start == ''){
                echo "<script>alert('tanggal mulai harus di isi!');</script>";
              }
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png'
              AND $extensionImg !=='gif' AND $extensionImg !==''){
                echo "<script>alert('extension file harus jpg, jpeg, png, gif ');</script>";
              }
              else if($sizeImg > 5000000){
                echo "<script>alert('max ukuran file 5mb');</script>";
              }
              else{//valid
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name;
                $image_name_old= $data['image_slider'];

                if(!empty($location)){//jika filenya tidak kosong / ada file
                  //hapus file lama
                  if(file_exists("assets/image_slider/$image_name_old")){                  
                    unlink("assets/image_slider/$image_name_old");       
                  }
                  //masukan file baru
                  move_uploaded_file($location,"assets/image_slider/$image_file");

                  //update db
                  if($date_end == ''){
                    $update = $conn->query("UPDATE slider SET name_slider = '$name', sequence_slider ='$sequence'
                    ,hyperlink_slider = '$hyperlink', date_start_slider ='$date_start', 
                    image_slider = '$image_file'
                    WHERE id_slider='$id_slider'");
                  }
                  else{
                    $update = $conn->query("UPDATE slider SET name_slider = '$name', sequence_slider ='$sequence'
                    ,hyperlink_slider = '$hyperlink', date_start_slider ='$date_start', 
                    image_slider = '$image_file', date_end_slider ='$date_end'
                    WHERE id_slider='$id_slider'");
                  }
                  
                  
                }
                else{//file tidak ada
                  //update db tanpa foto baru
                  if($date_end == ''){
                    $update = $conn->query("UPDATE slider SET name_slider = '$name', sequence_slider ='$sequence'
                  ,hyperlink_slider = '$hyperlink', date_start_slider ='$date_start'
                  WHERE id_slider='$id_slider'");
                  }
                  else{
                    $update = $conn->query("UPDATE slider SET name_slider = '$name', sequence_slider ='$sequence'
                    ,hyperlink_slider = '$hyperlink', date_start_slider ='$date_start', 
                    date_end_slider ='$date_end'
                    WHERE id_slider='$id_slider'");
                  }
                      
                }

                if($update){
                  echo "<script>alert('Slider berhasil di ubah!');</script>";
                  echo "<script>location='mslider.php';</script>";
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