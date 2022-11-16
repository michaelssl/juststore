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
  <title>Manage Category</title>
</head>

<body>
  <?php include 'navbar.php'; ?>

<div class="container">
  <nav class="navbar navbar-light">
    <a class="navbar-brand h1 mr-auto" href="#">Category</a>

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="keyword" id="keyword">
        <!-- <button class="btn btn-outline-info  my-2 my-sm-0" type="submit">Search</button> -->
      </form>
      <a href="mcategoryadd.php" class="btn btn-success ml-2">+ Add</a>
  </nav>

  
<!-- pagination -->
<?php 
    //configure
    $table=$conn->query("SELECT * FROM category");

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
  
  <!-- table -->
  <div id="container">
  <table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Name</th>
      <th>Icon</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- ngambil data -->
    <?php  
      $result = $conn->query("SELECT * FROM category ORDER BY name_category LIMIT $start_data,$data_perpage");
      while($data = $result->fetch_assoc()){
    ?>
    <tr>
      <td><?php echo $data['name_category']; ?></td>
      <td>
        <img src="assets/image_category/<?php echo $data['image_category']; ?>" alt="category_icon" width="25px">
        <?php 
        echo $data['date_update_category'];
        echo " - ";
        echo $data['image_category']; ?>
      </td>
      <td>
        <a href="mcategoryedit.php?id=<?php echo $data['id_category']; ?>" class="btn btn-warning">Edit</a>
        <a href="mcategorydelval.php?id=<?php echo $data['id_category']; ?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>

</div>



  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/scriptCategory.js"></script>
</body>

</html>