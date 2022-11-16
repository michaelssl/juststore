<?php 
include '../db.php';
$keyword=$_GET['keyword'];

$result= $conn->query("SELECT * FROM slider WHERE
name_slider LIKE '%$keyword%' OR 
image_slider LIKE '%$keyword%' OR
hyperlink_slider LIKE '%$keyword%' OR
date_start_slider LIKE '%$keyword%'OR
date_end_slider LIKE '%$keyword%' OR
sequence_slider LIKE '%$keyword%'
ORDER BY sequence_slider ");

?>


<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Sequence</th>
      <th>Name</th>
      <th>Image</th>
      <th>Hyperlink</th>
      <th>Start At</th>
      <th>End At</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- ngambil data -->
    <?php 
      
      while($data = $result->fetch_assoc()){
    ?>
    <tr>
      <td><?php echo $data['sequence_slider']; ?></td>
      <td><?php echo $data['name_slider']; ?></td>
      <td><img src="assets/image_slider/<?php echo $data['image_slider'] ?>" alt="image_slider"
      width="200px"></td>
      <td><?php echo $data['hyperlink_slider']; ?></td>
      <td><?php echo $data['date_start_slider']; ?></td>
      <td><?php echo $data['date_end_slider']; ?></td>

      <td>
        <a href="mslideredit.php?id=<?php echo $data['id_slider']; ?>" class="btn btn-warning">Edit</a>
        <a href="msliderdelval.php?id=<?php echo $data['id_slider'];?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
      <?php } ?>
  </tbody>
</table>