<?php 
  session_start();
  include 'db.php';
  
  $id_product = $_GET['id'];
  $id_member =$_SESSION['member']['id_member'];

  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }
  else{
    $result_review = $conn->query("SELECT * FROM review WHERE id_member ='$id_member' AND id_product = '$id_product' ");

    if($result_review->num_rows == 1){//jika sudah kasih review
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

  <title>Review</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <div class="card">
        <h3 class="card-header">Rating & Review</h3>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="rating">Rating</label>
              <input type="number" class="form-control" id="rating" min="1" max="5" name="rating" required>
            </div>
            <div class="form-group">
              <label for="review">Review</label>
              <textarea class="form-control" id="review" rows="3" placeholder="Review..." name="review"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="give">Give Review</button>
          </form>
          <?php 
            if(isset($_POST['give'])){
              $id_product = $_GET['id'];
              $id_member =$_SESSION['member']['id_member'];
              $rating = $_POST['rating'];
              $review = $_POST['review'];
              //waktu
              $hour=date('H');
              $gmt7 =$hour+6; //GMT +7
              $time = date('Y-m-d '). $gmt7 .date(':i:s');

              $insert= $conn->query("INSERT INTO review (id_member,id_product,rating_review,isi_review,
              date_review)VALUES('$id_member','$id_product','$rating','$review','$time')");

                if($insert){
                  echo "<script>alert('Review telah diisi!'); </script>";
                  echo "<script>location='history.php';</script>";
                }
                else{
                  echo $conn->error;
                }

            }




          ?>



        </div>
      </div>
    </div>
    <div class="col-sm-3"></div>
  </div>
</div>





<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>

</body>
</html>