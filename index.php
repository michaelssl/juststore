<?php session_start();
include 'db.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Index</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <!-- Slider -->
  <div class="container mb-3 mt-4">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        
        <div class="carousel-item active">
          <!-- default -->
          <a href=""><img src="assets/image_slider/image_slider.jpg" class="d-block w-100" alt="..."></a>
        </div>

        <?php 
          $result_slider =$conn->query("SELECT * FROM slider ORDER BY sequence_slider");
          while($data_slider = $result_slider->fetch_assoc()){
        ?>
      <!-- looping -->
        <div class="carousel-item">
          <a href="<?php echo $data_slider['hyperlink_slider'];  ?>" target="_blank">
          <img src="assets/image_slider/<?php echo $data_slider['image_slider']; ?>" class="d-block w-100" alt="slider">
          </a>
        </div>
        
          <?php } ?>
      </div>
    </div>
  </div>

  
  <!-- Category -->
  <div class="container">
    <?php 
      $result_category = $conn->query("SELECT * FROM category ORDER BY name_category");
      while($data_category = $result_category->fetch_assoc()){
    ?>
    <!-- looping -->
    <a href="search.php?id=<?php echo $data_category['id_category']; ?>" class="btn btn-outline-secondary ml-2 mb-2 mt-2">
      <img src="assets/image_category/<?php echo $data_category['image_category']; ?>" 
      alt="cateogory" width="25px"><?php echo $data_category['name_category']; ?>
    </a>
    <?php } ?>

  </div>





  <!-- Product -->
<section class="product-list">
  <div class="container">
    <div class="row">
    <?php 
      $result_product = $conn->query("SELECT * FROM `product` ORDER BY name_product");
      //LEFT JOIN `review` ON product.id_product = review.id_product

      while($data_product = $result_product->fetch_assoc()){
    ?>

    <!-- akan dilooping -->
    <div class="col-lg-3 col-md-4 ml-2">
      <div class="card" style="width: 18rem;">

        <img src="assets/image_product/<?php echo $data_product['image_product']; ?>" class="card-img-top img-thumbnail img-fluid" alt="image_product">
        <div class="card-body">
          <h5 class="card-title"><?php echo $data_product['name_product'] ?></h5>
          <h6 class="card-subtitle mb-2 text-muted">Rp. <?php echo number_format($data_product['price_product']); ?></h6>
          <p>
            
          </p>
          <a href="productDetail.php?id=<?php echo $data_product['id_product'] ?>" class="btn btn-primary">Detail</a>
        </div>
      </div>
    </div>
      <?php } ?>

    </div>
  </div>
</section> 




  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script>
    $('.carousel').carousel({
      interval: 3500,
      pause: "hover"
    })
  </script>
</body>

</html>