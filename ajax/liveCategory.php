<?php 
include '../db.php';
$keyword=$_GET['keyword'];

$result= $conn->query("SELECT * FROM category WHERE
name_category LIKE '%$keyword%' OR 
image_category LIKE '%$keyword%' OR
date_update_category LIKE '%$keyword%'
");

?>

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