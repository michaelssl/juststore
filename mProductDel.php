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

  $id_product = $_GET['id'];
  $result= $conn->query("SELECT * FROM product WHERE id_product = '$id_product'");
  $row=$result->fetch_assoc();
  $image_name_old= $row['image_product'];
    if(file_exists("assets/image_product/$image_name_old")){                  
      unlink("assets/image_product/$image_name_old");       
    }
  $delete= $conn->query("DELETE FROM product WHERE id_product = '$id_product'");
  if($delete){
    echo "<script>alert('product berhasil dihapus');</script>";
    echo "<script>location='mproduct.php';</script>";
  }
  else{
    $conn->error;
  }
?>