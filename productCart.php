<?php 
  session_start();
  include 'db.php';

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
  <title>Cart</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <!-- jika cart nya ada -->
  <?php if(!empty($_SESSION['cart'])): ?>
<div class="container">
  <nav class="navbar navbar-light">
    <div class="list-group list-group-horizontal">
      <a href="" class="list-group-item list-group-item-action active">Cart</a>
      <a href="" class="list-group-item list-group-item-action">Form</a>
      <a href="" class="list-group-item list-group-item-action">Verfication</a>
    </div>
  </nav>
  
  <!-- table -->
  <div id="container">
  <table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Name</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Total</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $grand_total =  0;
      foreach($_SESSION['cart'] as $id_product => $jumlah):?>
      <?php 
        $result_product = $conn->query("SELECT * FROM product WHERE id_product = '$id_product'");
        $data_product =$result_product->fetch_assoc();
        $total_harga = $data_product['price_product'] * $jumlah;
        $grand_total +=$total_harga;
      ?>
      <tr>
        <td>
          <img src="assets/image_product/<?php echo $data_product['image_product']; ?>" alt="image_product"
          class="img-fluid" width="50px">
          <?php echo $data_product['name_product']; ?>
        </td>
        <td>Rp. <?php echo number_format($data_product['price_product']); ?></td>
        <td><?php echo $jumlah ?></td>
        <td>Rp. <?php echo number_format($total_harga); ?></td>
        <td>
          <a href="productCartDelVal.php?id=<?php echo $data_product['id_product']; ?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>

    <tr>
      <td colspan=3>Grand Total:</td>
      <td><strong>Rp. <?php echo number_format($grand_total); ?></strong></td>
      <td><a href="productCheckoutForm.php" class="btn btn-success">Next</a></td>
    </tr>
  </tbody>
</table>
<a href="index.php" class="btn btn-outline-secondary">Lanjut Belanja</a>
<!-- jika cart nya kosong -->
  <?php else:?>
    <div class="container text-center mt-5">
      <h1>Cart Kosong :(</h1>
      <a href="index.php" class="btn btn-outline-secondary">Start Shopping</a>
    </div>

<?php endif; ?>
</div>

</div>



  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>