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

  $id_staffadmin = $_GET['id'];
  $result= $conn->query("SELECT * FROM member WHERE id_member = '$id_staffadmin'");
  $row=$result->fetch_assoc();
  $image_name_old= $row['image_profile'];

    //validasi foto, jika bukan foto default hps file fotonya yg lama
    if($image_name_old !== 'profile_default.png' AND file_exists("assets/image_profile/$image_name_old")){                  
      unlink("assets/image_profile/$image_name_old");       
    }

  $delete= $conn->query("DELETE FROM member WHERE id_member = '$id_staffadmin'");
  if($delete){
    echo "<script>alert('Staff/Admin berhasil dihapus');</script>";
    
    echo "<script>location='mstaffadmin.php';</script>";
  }
  else{
    $conn->error;
  }
?>