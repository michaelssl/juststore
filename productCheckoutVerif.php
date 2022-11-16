<?php 
  session_start();
  include 'db.php';

  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }

  else if(empty($_SESSION['cart'])){//jika cart kosong
    header("location:index.php");
  } 
  else if(!isset($_GET['next'])){//jika belum melewati page form atau tombol next blm di tekan
    header("location:index.php");
  }

  $address=$_GET['address'];
  $id_courier =$_GET['courier'];
  $phone = $_GET['phone'];
  $notes =$_GET['notes'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Verification Checkout</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <!-- jika cart nya ada -->
<div class="container">
  <nav class="navbar navbar-light">
    <div class="list-group list-group-horizontal">
      <a href="" class="list-group-item list-group-item-action">Cart</a>
      <a href="productcheckoutform.php" class="list-group-item list-group-item-action">Form</a>
      <a href="" class="list-group-item list-group-item-action active">Verfication</a>
    </div>
  </nav>


  <div class="card text-center">
  <h1 class="card-header">Verification</h1>
  <div class="card-body">
    <h6 class="card-title">Your Purchases:</h6>
    <!-- looping -->
    <?php 
      $grand_total =  0;
      foreach($_SESSION['cart'] as $id_product => $jumlah):?>
      <?php 
        $result_product = $conn->query("SELECT * FROM product WHERE id_product = '$id_product'");
        $data_product =$result_product->fetch_assoc();
        $total_harga = $data_product['price_product'] * $jumlah;
        $grand_total +=$total_harga;
      ?>
    <p class="card-text">
      <strong><?php echo $jumlah; ?></strong>
      item 
      <strong><?php echo $data_product['name_product']; ?></strong>
    </p>
    <!-- end looping -->
      <?php endforeach; ?>
      <?php 
        $result_courier= $conn->query("SELECT * FROM courier WHERE id_courier= '$id_courier'");
        $data_courier=$result_courier->fetch_assoc();
        $grand_total +=$data_courier['price_courier'];
      ?>
    <p class="card-text">Courier: <strong><?php echo $data_courier['name_courier']; ?></strong></p>
    <p class="card-text">Total Purchases: <strong><?php echo number_format($grand_total); ?></strong></p>
    <form method="post">
      <button type="submit" class="btn btn-success" name="checkout"><strong>Checkout</strong></button>
    </form>

    <?php 
      if(isset($_POST['checkout'])){
        $id_member = $_SESSION['member']['id_member'];
        $hour=date('H');
        $gmt7 =$hour+6; //GMT +7
        $time= date('Y-m-d '). $gmt7 .date(':i:s');

        //insert data ke table transaction
        $insert = $conn->query("INSERT INTO `transaction` (id_member,id_courier,address_transaction,phone_transaction,notes_transaction,total_transaction,date_transaction) VALUES ('$id_member','$id_courier','$address','$phone','$notes','$grand_total','$time')");

        //ambil id transaction yang baru
        $id_transaction = $conn->insert_id;
        
        
        foreach($_SESSION['cart'] as $id_product => $jumlah){
          //masukan data ke table transaction_detail
          $insert2 = $conn->query("INSERT INTO transaction_detail (id_transaction,id_product,qty_product)
          VALUES ('$id_transaction','$id_product','$jumlah')");

          //update stock
          $udpate = $conn->query("UPDATE product SET stock_product = stock_product - '$jumlah'
          WHERE id_product='$id_product' ");
        }

        //kosongkan cart
        unset($_SESSION['cart']);

          if($insert2){
            echo "<script>alert('Product berhasil di beli');</script>";
            echo "<script>location='history.php';</script>";
          }
          else{
            echo $conn->error;
          }


      }
    ?>

    
  </div>
</div>

<a href="productcheckoutform.php" class="btn btn-outline-success mt-2">Prev</a>
</div>




  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>