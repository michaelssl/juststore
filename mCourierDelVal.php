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
$id_courier=$_GET['id'];
$result= $conn->query("SELECT * FROM courier WHERE id_courier = $id_courier");
$row= $result->fetch_assoc();
$name= $row['name_courier'];

echo "<script> let r = confirm('Apakah anda yakin ingin menghapus ". $name;
echo " ini ?'); 
  if(r==true){
      location = 'mCourierDel.php?id=".$id_courier;
echo "';
  }
  else {
    alert('di cancel!');
    location = 'mcourier.php';
  }
  </script>";
?>