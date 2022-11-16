<?php 
  session_start();
  include 'db.php';

  if(!isset($_SESSION['member'])){//jika belum login
    header("location:index.php");
  }

  $id_product =$_GET['id'];
  unset($_SESSION['cart'][$id_product]);

  echo "<script>alert(product berhasil di hapus dari cart);</script>";
  echo "<script>location='productcart.php';</script>";

?>