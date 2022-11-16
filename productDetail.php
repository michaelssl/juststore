<?php 
  session_start();
  include 'db.php';
  $id_product = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Detail Product</title>
</head>
<body>
  <?php include 'navbar.php' ?>
  
  <!-- detail product -->
  <section class="detail-product">
    <div class="container">
      <div class="row">
      <?php 
        $result_product = $conn->query("SELECT * FROM product WHERE id_product = '$id_product'");
        $data_product = $result_product->fetch_assoc();      
      ?>


        <div class="col-sm-6">
          <img src="assets/image_product/<?php echo $data_product['image_product']; ?>" alt="" class="img-fluid">
        </div>
        <div class="col-sm-6">
          <h1><?php echo $data_product['name_product']; ?></h1>
          <br>
          <p><?php echo $data_product['description_product']; ?></p>
          <p>Stock: <?php echo $data_product['stock_product']; ?></p>
          <h3>Rp. <?php echo number_format($data_product['price_product']); ?></h3>
          <form method="post">
            <div class="row">
              <div class="col">
                <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" min="1"
                max="<?php echo $data_product['stock_product'] ?>" required>
              </div>
              <div class="col">
                <button type="submit" class="btn btn-warning" name="add">Add To Cart</button>
              </div>
            </div>
          </form>
        </div>

        <!-- detail product logic -->
        <?php //add to cart validation
          //blm login
          if(!isset($_SESSION['member']) AND isset($_POST['add'])){
            echo "<script>alert('login terlebih dahulu');</script>";
            echo "<script>location='index.php'</script>";
          }
          //email belum terverifikasi
          else if(isset($_SESSION['member'])AND $_SESSION['member']['verified']== 0 AND isset($_POST['add'])){
            echo "<script>alert('email belum terverifikasi. produk gagal di tambahkan');</script>";
            echo "<script>location='index.php'</script>";
          }
          else{
            if(isset($_POST['add'])){//valid
              $jumlah = $_POST['jumlah'];
              $_SESSION['cart'][$id_product] = $jumlah;
              echo "<script>alert('Product telah masuk ke cart!');</script>";
              echo "<script>location='productCart.php'</script>";
            }
          }
          
        ?>


      </div>
    </div>
  </section>

<!-- reviews -->
<div class="container">
  <h4>Review</h4>
  <div class="card" >
  
    <ul class="list-group list-group-flush">
      <!-- looping -->
      <?php 
        $result_review =$conn->query("SELECT * FROM review r JOIN member m ON r.id_member = m.id_member
        WHERE id_product = '$id_product' ");
        while($data_review = $result_review->fetch_assoc()){
      ?>
      
      <li class="list-group-item">
        <h5><?php echo $data_review['name_member']; ?></h5>
        <p><?php echo $data_review['date_review']; ?>
          <br>
          <?php for($i=0 ; $i < $data_review['rating_review'] ;$i++): ?>
          &#9733;
          <?php endfor; ?>
          <?php for($i=0 ; $i < (5-$data_review['rating_review']) ;$i++): ?>
          &#9734;
          <?php endfor; ?>
        </p>
        <p><?php echo $data_review['isi_review']; ?></p>
      </li>
        <?php } ?>
    </ul>
  </div>
</div>



<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
</body>
</html>