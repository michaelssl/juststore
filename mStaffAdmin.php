<?php 
include 'db.php';
session_start();
  
  //validasi role (admin only)
  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }
  else{//sudah login
    
    if($_SESSION['member']['role_member']!== 'admin'){
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
  <title>Manage Staff/Admin</title>

  
</head>

<body>
  <?php include 'navbar.php'; ?>

<div class="container">
  <nav class="navbar navbar-light">
    <a class="navbar-brand h1" href="#">Staff/Admin</a>
    <a href="mstaffadminadd.php" class="btn btn-success ml-2  mr-auto">+ Add</a>

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="keyword" id="keyword">
        <!-- <button class="btn btn-outline-info  my-2 my-sm-0" type="submit" id="btn-search">Search</button> -->
      </form>
      
  </nav>

  
<!-- pagination -->
<?php 
    //configure
    $table=$conn->query("SELECT * FROM member WHERE role_member='admin' OR role_member='staff'");

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
      <th>Gender</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- ngambil data -->
    <?php 
      $result= $conn->query("SELECT * FROM member WHERE role_member='admin' OR role_member='staff' ORDER BY name_member LIMIT $start_data,$data_perpage");
      while($data=$result->fetch_assoc()){
    ?>
    <tr>
      <td><?php echo $data['name_member']; ?></td>
      <td><?php echo $data['gender_member']; ?></td>
      <td><?php echo $data['phone_member']; ?></td>
      <td><?php echo $data['email_member']; ?></td>
      <td>
        <a href="mstaffadminedit.php?id=<?php echo $data['id_member'] ?>" class="btn btn-warning">Edit</a>
        <a href="mstaffadmindelval.php?id=<?php echo $data['id_member'] ?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
      <?php } ?>
  </tbody>
</table>
</div>

</div>


  
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/scriptStaffAdmin.js"></script>
</body>

</html>