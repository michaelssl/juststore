<?php 
  include 'db.php';
  session_start();
    
    if(!isset($_SESSION['member'])){//jika belum login
      header("location:index.php");
    }

?>
<?php 
$id_product=$_GET['id'];
$result= $conn->query("SELECT * FROM product WHERE id_product = $id_product");
$row= $result->fetch_assoc();
$name= $row['name_product'];

echo "<script> let r = confirm('Apakah anda yakin ingin menghapus " .$name;
echo " ?'); 
  if(r==true){
      location = 'productcartDel.php?id=".$id_product;
echo "';
  }
  else {
    alert('di cancel!');
    location = 'productcart.php';
  }
  </script>";
?>