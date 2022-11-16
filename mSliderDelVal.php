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
$id_slider=$_GET['id'];
$result= $conn->query("SELECT * FROM slider WHERE id_slider = $id_slider");
$row= $result->fetch_assoc();
$name= $row['name_slider'];

echo "<script> let r = confirm('Apakah anda yakin ingin menghapus " .$name;
echo " ?'); 
  if(r==true){
      location = 'msliderDel.php?id=".$id_slider;
echo "';
  }
  else {
    alert('di cancel!');
    location = 'mslider.php';
  }
  </script>";
?>