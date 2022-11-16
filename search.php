<?php 
  session_start();
  include 'db.php';

  if(empty($_GET)){//jika tidak ada keyword
    header("location:index.php");
  }


    if(isset($_GET['keyword'])){//jika hanya keyword ada
      $keyword = $_GET['keyword'];
      $sort = (isset($_GET['sort']) ? $_GET['sort'] : ' ');
      $result_product = $conn->query("SELECT * FROM `product` WHERE 
      name_product LIKE '%$keyword%' OR
      description_product LIKE '%$keyword%'
      ORDER BY name_product $sort");
      
    }
    if(isset($_GET['id'])){//jika hanya id category ada
      $sort = (isset($_GET['sort']) ? $_GET['sort'] : ' ');
      $id_category = $_GET['id'];
      $result_product = $conn->query("SELECT * FROM `product` WHERE id_category = '$id_category'      
      ORDER BY name_product $sort");
    }

    if(isset($_GET['id']) AND isset($_GET['start']) AND isset($_GET['end'])){// jika id dan price ada
      $sort = (isset($_GET['sort']) ? $_GET['sort'] : ' ');
      $id_category = $_GET['id'];
      $start = $_GET['start'];
      $end = $_GET['end'];
      $result_product = $conn->query("SELECT * FROM `product` WHERE id_category = '$id_category'
      AND price_product BETWEEN $start AND $end     
      ORDER BY name_product $sort");
    }

    if(isset($_GET['keyword']) AND isset($_GET['start']) AND isset($_GET['end'])){// jika keyword dan price ada
      $sort = (isset($_GET['sort']) ? $_GET['sort'] : ' ');
      $keyword = $_GET['keyword'];
      $start = $_GET['start'];
      $end = $_GET['end'];
      $result_product = $conn->query("SELECT * FROM `product` WHERE 
      (name_product LIKE  '%$keyword%' OR
      description_product LIKE '%$keyword%')
      AND price_product BETWEEN $start AND $end
      ORDER BY name_product $sort");
    }
  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Searching</title>
</head>
<body>
    <?php include 'navbar.php'; ?>

  <div class="mx-5 my-5">
    <div class="row">
    <!-- Search category -->
      <div class="col-2">
        <div class="row">
          <!-- sorting -->
          <div class="col-12 mb-5">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sorting
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" 
                href="search.php<?php if(isset($_GET['keyword']) AND isset($_GET['start']) AND isset($_GET['end'])): ?>?keyword=<?php echo $keyword; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>&sort=asc<?php elseif(isset($_GET['id']) AND isset($_GET['start']) AND isset($_GET['end'])): ?>?id=<?php echo $id_category; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>&sort=asc<?php elseif(isset($_GET['id'])): ?>?id=<?php echo $id_category; ?>&sort=asc<?php elseif(isset($_GET['keyword'])): ?>?keyword=<?php echo $keyword; ?>&sort=asc
                
                <?php endif; ?>
                "
                >A - Z</a>
                <a class="dropdown-item" 
                href="search.php<?php if(isset($_GET['keyword']) AND isset($_GET['start']) AND isset($_GET['end'])): ?>?keyword=<?php echo $keyword; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>&sort=desc<?php elseif(isset($_GET['id']) AND isset($_GET['start']) AND isset($_GET['end'])): ?>?id=<?php echo $id_category; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>&sort=desc<?php elseif(isset($_GET['id'])): ?>?id=<?php echo $id_category; ?>&sort=desc<?php elseif(isset($_GET['keyword'])): ?>?keyword=<?php echo $keyword; ?>&sort=desc
                
                <?php endif; ?>
                "
                >Z - A</a>
              </div>
            </div>
          </div>

          <!-- category -->
          <div class="col-12 mb-5 ">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
              </button>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <?php 
                $result_category = $conn->query("SELECT * FROM category ORDER BY name_category");
                while($data_category = $result_category->fetch_assoc()){
              ?>
                
                <a href="search.php?id=<?php echo $data_category['id_category']; ?>" class="dropdown-item">
                  <img src="assets/image_category/<?php echo $data_category['image_category']; ?>" 
                  alt="cateogory" width="25px"><?php echo $data_category['name_category']; ?>
                </a>
              <?php } ?>
              </div>
            </div>
          </div>

          <!-- SORT Price -->
          <div class="col-12">
            <form method="get" action="search.php">
              <div class="form-group">
                  <label>Price</label>
                  <input type="hidden" 
                  <?php if(isset($_GET['id'])): ?>
                    name="id"
                    value="<?php echo $id_category; ?>"
                  <?php elseif(isset($_GET['keyword'])): ?>
                    name="keyword"
                    value="<?php echo $keyword; ?>"
                  <?php endif; ?>>
                  <input type="number" class="form-control" placeholder="Start" min=0 name="start" required>
                  <input type="number" class="form-control" placeholder="End" min=0 name="end" required>
                  <button class="btn btn-outline-secondary" type="submit">&#9906;</button>
                </div>
            </form>
          </div>




        </div>
      </div>

    <!-- result search -->
      <div class="col-10" >
        <div class="row">


        <?php while($data_product = $result_product->fetch_assoc()){ ?>
    <!-- akan dilooping -->
    <div class="col-lg-3">
      <div class="card" style="width: 18rem;">

        <img src="assets/image_product/<?php echo $data_product['image_product']; ?>" class="card-img-top img-thumbnail" alt="image_product">
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

    </div>
  </div>



  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>
</html>