<?php 
    include '../db.php';
    $keyword=$_GET['keyword'];

    $result= $conn->query("SELECT * FROM product WHERE
    name_product LIKE '%$keyword%' OR 
    stock_product LIKE '%$keyword%' OR
    price_product LIKE '%$keyword%'
    ");
?>


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
      while($data= $result->fetch_assoc()){
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