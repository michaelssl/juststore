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

  $id_slider = $_GET['id'];
  $result= $conn->query("SELECT * FROM slider WHERE id_slider = '$id_slider'");
  $row=$result->fetch_assoc();
  $image_name_old= $row['image_slider'];

    //validasi foto, hps file fotonya yg lama
    if(file_exists("assets/image_slider/$image_name_old")){                  
      unlink("assets/image_slider/$image_name_old");       
    }

  $delete= $conn->query("DELETE FROM slider WHERE id_slider = '$id_slider'");
  if($delete){
    echo "<script>alert('Slider berhasil dihapus');</script>";
    
    echo "<script>location='mslider.php';</script>";
  }
  else{
    echo $conn->error;
  }
?>