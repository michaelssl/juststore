<?php 
  include 'db.php';
  if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];
    $result = $conn->query("SELECT verified,vkey FROM member WHERE verified = 0 AND vkey= '$vkey' LIMIT 1");

    if($result->num_rows == 1){
      $update = $conn->query("UPDATE member SET verified = 1 WHERE vkey='$vkey'");

      if($update){
        echo "<script>alert('akun telah terverifikasi');</script>";
        echo "<script>location='index.php';</script>";
      }
      else{
        echo $conn->error;
      }
    }
    else{
      echo "akun invalid atau sudah terverifikasi";
    }
  }
  else{
    die("Ada Kesalahan :( ");
  }

?>