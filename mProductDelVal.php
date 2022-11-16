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
<?php 
$id_product=$_GET['id'];
$result= $conn->query("SELECT * FROM product WHERE id_product = $id_product");
$row= $result->fetch_assoc();
$name= $row['name_product'];

echo "<script> let r = confirm('Apakah anda yakin ingin menghapus ".$name;
echo " ini ?'); 
  if(r==true){
      location = 'mproductDel.php?id=".$id_product;
echo "';
  }
  else {
    alert('di cancel!');
    location = 'mproduct.php';
  }
  </script>";
?>