
<?php 
  session_start();
  include 'db.php';
  
  $id_product = $_GET['id'];
  $id_member =$_SESSION['member']['id_member'];

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

  <title>Review</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <h3>Rating & Review  <a href="history.php" class="btn btn-outline-danger text-right">X</a></h3>
          
        </div>
        <div class="card-body">
        <?php 
            $result_review = $conn->query("SELECT * FROM review WHERE id_member ='$id_member' AND id_product = '$id_product' ");
            $data_review = $result_review->fetch_assoc();
        ?>
        <form method="post">
          <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" class="form-control" id="rating" min="1" max="5" name="rating" disabled
              value="<?php echo $data_review['rating_review']; ?>">
          </div>
          <div class="form-group">
            <label for="review">Review</label>
            <textarea class="form-control" id="review" rows="3" placeholder="" name="review"
              disabled><?php echo $data_review['isi_review']; ?></textarea>
          </div>
        </form>




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