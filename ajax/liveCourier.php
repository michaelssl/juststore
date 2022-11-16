<?php 
include '../db.php';
$keyword=$_GET['keyword'];

$result= $conn->query("SELECT * FROM courier WHERE
name_courier LIKE '%$keyword%' OR 
image_courier LIKE '%$keyword%' OR
price_courier LIKE '%$keyword%' OR
date_update_courier LIKE '%$keyword%'
");

?>
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Name</th>
      <th>Cost</th>
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
      <td><?php echo $data['name_courier']; ?></td>
      <td><?php echo $data['price_courier']; ?></td>
      <td>
        <img src="assets/image_courier/<?php echo $data['image_courier']; ?>" alt="courier_icon" width="40px">
        <?php 
        echo $data['date_update_courier'];
        echo " - ";
        echo $data['image_courier']; ?>
      </td>
      <td>
        <a href="mcourieredit.php?id=<?php echo $data['id_courier']; ?>" class="btn btn-warning">Edit</a>
        <a href="mcourierdelval.php?id=<?php echo $data['id_courier']; ?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>