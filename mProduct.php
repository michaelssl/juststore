<?php 
include 'db.php';
session_start();
  
  //validasi role (staff and admin only)
  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }
  else{//sudah login
    //jika member
    if($_SESSION['member']['role_member']!== 'staff' AND $_SESSION['member']['role_member']!== 'admin'){
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
  <title>Manage Product</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

  

<div class="container">
  <nav class="navbar navbar-light">
    <a class="navbar-brand h1" href="#">Product</a>
    <a href="mproductadd.php" class="btn btn-success ml-2 mr-auto">+ Add</a>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" id="keyword" name="keyword">
        <!-- <button class="btn btn-outline-info  my-2 my-sm-0" type="submit">Search</button> -->
      </form>
      
  </nav>
  <!-- pagination -->
  <?php 
    //configure
    $table=$conn->query("SELECT * FROM product");

    $data_perpage = 8;
    $sum_data = $table->num_rows;
    $sum_page = ceil($sum_data / $data_perpage);
    $page_active = ( isset($_GET['page'])) ? $_GET['page'] : 1;
    $start_data = ($data_perpage * $page_active) - $data_perpage;
  ?>
  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <?php if($page_active > 1): ?>
      <a class="page-link" href="?page=<?php echo $page_active-1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
      <?php else: ?>
        <a class="page-link" href="?page=<?php echo 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
      <?php endif; ?>
    </li>
    <?php for($i=1 ; $i<= $sum_page ; $i++): ?>
      <?php if($i == $page_active): ?>
        <li class="page-item active">
      <?php else: ?>
        <li class="page-item">
      <?php endif; ?>
      <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    </li>
    <?php endfor; ?>

    <li class="page-item">
      <?php if($page_active < $sum_page): ?>
      <a class="page-link" href="?page=<?php echo $page_active+1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
      <?php else: ?>
        <a class="page-link" href="?page=<?php echo $sum_page; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
      <?php endif; ?>
    </li>
  </ul>
</nav>
<!-- end pagination -->

  
  <div id="container">
  <!-- table -->
  <table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Name</th>
      <th>Cost</th>
      <th>Stock</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  

    <!-- ngambil data -->
    <?php 
      $result= $conn->query("SELECT * FROM product ORDER BY name_product LIMIT $start_data, $data_perpage");
      while($data=$result->fetch_assoc()){
    ?>
    <tr>
      <td>
        <img src="assets/image_product/<?php echo $data['image_product']; ?>" alt="image_product" width="50px">
        <?php echo $data['name_product']; ?>
      </td>
      <td>Rp. <?php echo number_format($data['price_product']); ?></td>
      <td><?php echo $data['stock_product']; ?><td>
        <a href="mproductedit.php?id=<?php echo $data['id_product']; ?>" class="btn btn-warning">Edit</a>
        <a href="mproductdelval.php?id=<?php echo $data['id_product']; ?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
      <?php } ?>
  </tbody>
</table>
</div>

</div>



  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/scriptProduct.js"></script>
</body>

</html>