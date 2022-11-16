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
  <title>Shopping History</title>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="container">
    <h1>Shopping History</h1>

    <!-- dapatkan total transaction dari id member -->
    <?php 
    $id_member = $_SESSION['member']['id_member'];
      $result_transaction = $conn->query("SELECT * FROM `transaction` WHERE id_member = '$id_member' ");
      ?>

      <?php //cek transaksi
        if($result_transaction->num_rows != 0):
      ?>

    
  <?php while($data_transaction = $result_transaction->fetch_assoc()){ ?>
    <div class="card mb-2">
        <p class="card-header">Transaction ID: <?php echo $data_transaction['id_transaction']; ?>
          <br>Transaction Date: <?php echo $data_transaction['date_transaction']; ?>  
        </p>

      <div class="card-body ">
        <p class="card-text">
          <?php //ambil data courier
            $id_courier = $data_transaction['id_courier']; 
            $result_courier =$conn->query("SELECT * FROM courier WHERE id_courier = '$id_courier'");
            $data_courier = $result_courier->fetch_assoc();
          
          ?>
          <strong>Courier Name: </strong><?php echo $data_courier['name_courier']; ?>
          <br>
          <strong>Courier Cost: </strong><?php echo number_format($data_courier['price_courier']); ?>
          <br>
          <strong>Address: </strong><?php echo $data_transaction['address_transaction']; ?>
          <br>
          <strong>Phone: </strong><?php echo $data_transaction['phone_transaction']; ?>
          <br>
          <strong>Notes: </strong><?php echo $data_transaction['notes_transaction']; ?>
          <br>
        </p>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Review</th>
            </tr>
          </thead>
          <tbody>
            <!-- ambil data transcation_detail -->
            <?php
              $id_transaction = $data_transaction['id_transaction'];
              $result_transaction_detail = $conn->query("SELECT * FROM transaction_detail 
              WHERE id_transaction = '$id_transaction'");
              while($data_transaction_detail = $result_transaction_detail->fetch_assoc()){
            ?>
            <?php //ambil data product
              $id_product=$data_transaction_detail['id_product'];
              $result_product= $conn->query("SELECT * FROM product WHERE id_product='$id_product'");
              $data_product = $result_product->fetch_assoc();
            ?>
            <tr>
              <td>
                <img src="assets/image_product/<?php echo $data_product['image_product'];?>" alt="img product"
                class="img-fluid" width="50px">
                <?php echo $data_product['name_product']; ?>
              </td>
              <td><?php echo $data_transaction_detail['qty_product']; ?></td>
              <td><?php echo number_format($data_product['price_product']); ?></td>
              <td>
                <!-- kondisi Review -->
                <?php 
                  $result_review = $conn->query("SELECT * FROM review WHERE
                  id_member ='$id_member' AND id_product = '$id_product' ");?>

                <?php if($result_review->num_rows ==1):// sudah memberi review ?>
                  <?php $data_review = $result_review->fetch_assoc(); ?>
                  
                      <a href="reviewSee.php?id=<?php echo $id_product; ?>" type="button" class="btn btn-outline-warning">
                      <?php for($i=0 ; $i < $data_review['rating_review'] ;$i++): ?>
                        &#9733;
                      <?php endfor; ?>
                      <?php for($i=0 ; $i < (5-$data_review['rating_review']) ;$i++): ?>
                        &#9734;
                      <?php endfor; ?>
                      </a>

                      
                      

                <?php else: //belum memberi review?> 
                <a href="review.php?id=<?php echo $data_product['id_product']; ?>" class="btn btn-warning">Give Review</a>
                <?php endif; ?>
              </td>
            </tr>

            <?php } ?>

            <tr>
                  <td colspan=2><strong>Grandtotal:</strong></td>
                  <td><strong>Rp. <?php echo number_format($data_transaction['total_transaction']); ?></strong></td>
                </tr>
          </tbody>
        </table>

        <!-- end card body -->
      </div>
      
      <!-- end card -->
    </div>
      <?php } ?>

<?php else: ?>
  <div class="text-center mt-5">
    <h1>Tidak Ada Transaki yang dilakukan :(</h1>
    <a href="index.php" class="btn btn-outline-secondary">Start Shopping</a>
  </div>


<?php endif; ?>

  <!-- end container -->
  </div>





  


  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>

</body>
</html>