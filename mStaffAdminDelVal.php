<?php 
  include 'db.php';
  session_start();
    
    //validasi role ( admin only)
    if(!isset($_SESSION['member'])){//jika belum login
      header("location:index.php");
    }
    else{//sudah login
      if($_SESSION['member']['role_member']!== 'admin'){
        header("location:index.php");
      }
    }
?>
<?php 
$id_staffadmin=$_GET['id'];
$result= $conn->query("SELECT * FROM member WHERE id_member = $id_staffadmin");
$row= $result->fetch_assoc();
$name= $row['name_member'];

echo "<script> let r = confirm('Apakah anda yakin ingin menghapus " .$name;
echo " ?'); 
  if(r==true){
      location = 'mstaffadminDel.php?id=".$id_staffadmin;
echo "';
  }
  else {
    alert('di cancel!');
    location = 'mstaffadmin.php';
  }
  </script>";
?>