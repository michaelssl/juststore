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
  <title>Add Slider</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Add Slider</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Slider Name" name="name" required>
            </div>
            
            <div class="form-group">
              <label for="sequence">Sequence</label>
              <input type="text" id="sequence" class="form-control" placeholder="Sequence: Min 1" name="sequence" required>
            </div>
            <div class="form-group">
              <label for="date_start">Start At</label>
              <input type="datetime-local" id="date_start" class="form-control" placeholder="..." name="date_start" required>
            </div>
            <div class="form-group">
              <label for="date_end">End At</label>
              <input type="datetime-local" id="date_end" class="form-control" placeholder="..." name="date_end" >
            </div>

            <div class="form-group">
              <label for="hyperlink">Hyperlink</label>
              <input type="text" id="hyperlink" class="form-control" placeholder="diawali dengan: http / https / localhost / 127.0.0.1" name="hyperlink" required>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
            
            <button type="submit" class="btn btn-primary" name="add">Add Slider</button>
          </form>
            
          <?php 
            if(isset($_POST['add'])){
              $name= $_POST['name'];
              $sequence = $_POST['sequence'];
              $date_start= $_POST['date_start'];
              $date_end = $_POST['date_end'];
              $hyperlink = $_POST['hyperlink'];
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];

              //mengecek hyperlink
              $count =stripos($hyperlink,"/");
              $link= substr($hyperlink,0,$count);

              //mengecek sequence
              $seq_query = $conn->query("SELECT * FROM slider WHERE sequence_slider ='$sequence' ");

              if(strlen($name) < 5){
                echo "<script>alert('nama slider minimal 5 huruf');</script>";
              }
              else if($link !== 'https:' AND $link !== 'http:' AND $link !== 'localhost' AND $link !== '127.0.0.1'){
                echo "<script>alert('harus diawali dengan http / https / localhost / 127.0.0.1');</script>";
              }
              else if($sequence < 1 OR $seq_query->num_rows != 0){
                echo "<script>alert('sequence minimal 1 atau sequnce sudah ada');</script>";
              }
              else if($date_start == ''){
                echo "<script>alert('tanggal mulai harus di isi!');</script>";
              }
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png'
              AND $extensionImg !=='gif'){
                echo "<script>alert('extension file harus jpg, jpeg, png, gif atau file tidak boleh kosong');</script>";
              }
              else if($sizeImg > 5000000){
                echo "<script>alert('max ukuran file 5mb');</script>";
              }
              else{//valid
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name;

                move_uploaded_file($location,"assets/image_slider/$image_file");

                if($date_end == ''){

                  $insert = $conn->query("INSERT INTO slider (name_slider,sequence_slider,hyperlink_slider,
                  date_start_slider, image_slider) VALUES('$name','$sequence
                  ','$hyperlink','$date_start','$image_file')");
                }
                else{
                  $insert = $conn->query("INSERT INTO slider (name_slider,sequence_slider,hyperlink_slider,
                  date_start_slider, date_end_slider,image_slider) VALUES('$name','$sequence
                  ','$hyperlink','$date_start', '$date_end','$image_file')");
                }

                  if($insert){
                    echo "<script>alert('Slider berhasil di tambahkan');</script>";
                    echo "<script>location='mSlider.php';</script>";
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