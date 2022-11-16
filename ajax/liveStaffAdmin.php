<?php 
  include '../db.php';
  $keyword=$_GET['keyword'];
  $result= $conn->query("SELECT * FROM member WHERE (role_member='admin' OR role_member='staff') AND
  (name_member LIKE '%$keyword%' OR 
  phone_member LIKE '%$keyword%' OR
  email_member LIKE '%$keyword%' OR
  gender_member LIKE '%$keyword%')
  ");

  

?>

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