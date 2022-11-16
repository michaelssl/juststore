<?php 
  session_start();
  include 'db.php';

  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }

  else if(empty($_SESSION['cart'])){
    header("location:index.php");
  } 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Form Checkout</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <!-- jika cart nya ada -->
<div class="container">
  <nav class="navbar navbar-light">
    <div class="list-group list-group-horizontal">
      <a href="" class="list-group-item list-group-item-action">Cart</a>
      <a href="" class="list-group-item list-group-item-action active">Form</a>
      <a href="" class="list-group-item list-group-item-action">Verfication</a>
    </div>
  </nav>

      <form method="get" action="productcheckoutverif.php">
            
            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="adress.." required></textarea>
            </div>

            <div class="form-group">
              <label for="courier">Courier</label>
              <select class="form-control" id="courier" name="courier">
                <?php 
                  $result_courier=$conn->query("SELECT * FROM courier ORDER BY price_courier");
                  while($data_courier =$result_courier->fetch_assoc()){
                ?>
                <option value="<?php echo $data_courier['id_courier'] ?>" >
                  <?php echo $data_courier['name_courier']; ?>
                  - Rp. <?php echo number_format($data_courier['price_courier']); ?>
                </option>
                  <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone..." required>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea class="form-control" id="notes" rows="3" name="notes" placeholder="adress..">
              </textarea>
            </div>
                    <div class="row">
                      <div class="col">
                        <a href="productcart.php" class="btn btn-outline-success">prev</a>
                      </div>
                      <div class="col">
                        <button type="submit" class="btn btn-success" name="next">Next</button>
                      </div>
                    </div>
          </form>

          <?php 
            if(isset($_GET['next'])){
              $address= $_GET['address'];
              $phone =$_GET['phone'];

              if(strlen($address) < 10){
                echo "<script>alert('address minimal 10 huruf');</script>";
              }
              else if(strlen($phone) < 10 OR !is_numeric($phone)){
                echo "<script>alert('phone minimal 10 angka atau harus angka');</script>";
              }
              else{//valid
              }

            }
          ?>
</div>





  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>