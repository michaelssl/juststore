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

  $id_courier = $_GET['id'];
  $result= $conn->query("SELECT * FROM courier WHERE id_courier = '$id_courier'");
  $row=$result->fetch_assoc();
  $image_name_old= $row['image_courier'];
    if(file_exists("assets/image_courier/$image_name_old")){                  
      unlink("assets/image_courier/$image_name_old");       
    }
  $delete= $conn->query("DELETE FROM courier WHERE id_courier = '$id_courier'");
  if($delete){
    echo "<script>alert('courier berhasil dihapus');</script>";
    echo "<script>location='mcourier.php';</script>";
  }
  else{
    $conn->error;
  }
?>