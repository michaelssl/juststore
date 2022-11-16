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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Edit Product</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Edit Product</h4>
          <div class="card-body">

          <?php
            $id_product=$_GET['id'];
            $result=$conn->query("SELECT * FROM product WHERE id_product='$id_product'");
            $data=$result->fetch_assoc();
          ?>
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" id="id" class="form-control" placeholder="product id" name="id" disabled
                value="<?php echo $data['id_product']; ?>">
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Product Name" name="name" required value="<?php echo $data['name_product']; ?>">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" rows="3" name="description" placeholder="Description product" required><?php echo $data['description_product']; ?>
            </textarea>
            </div>
            <div class="form-group">
              <label for="Price">Price</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="Price" required
              value="<?php echo $data['price_product']; ?>">
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="text" id="stock" class="form-control" placeholder="Min 0 " name="stock" required
              value="<?php echo $data['stock_product']; ?>">
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" id="category" name="category">
                <?php 
                $category_data =$conn->query("SELECT * FROM category ORDER BY name_category");
                while($row= $category_data->fetch_assoc()){
                ?>
                <option value="<?php echo $row['id_category'] ?>"
                <?php 
                  if($data['id_category'] == $row['id_category']) echo 'selected';
                ?>
                ><?php echo $row['name_category']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="image">Product Photo</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
          </form>

          <!-- logic php -->
          <?php 
            if(isset($_POST['save'])){
              $name_product= $_POST['name'];
              $description= $_POST['description'];
              $price =$_POST['price'];
              $stock= $_POST['stock'];
              $category=$_POST['category'];
              $extensionImg = basename($_FILES['image']['type']);
              $sizeImg = $_FILES['image']['size'];

              if(strlen($name_product) < 3){
                echo "<script>alert('nama product minimal 3 huruf');</script>";
              }
              else if(strlen($description) < 10){
                echo "<script>alert('description minimal 10 huruf');</script>";
              }
              else if($price < 10000){
                echo "<script>alert('harga minimal Rp. 10,000');</script>";
              }
              else if($stock < 0){
                echo "<script>alert('stock minimal 0');</script>";
              }
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png'
              AND $extensionImg !== ''){
                echo "<script>alert('extension file harus jpg, jpeg, png');</script>";
              }
              else if($sizeImg > 2000000){
                echo "<script>alert('max ukuran file 2mb');</script>";
              }
              else{//valid
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name;
                $image_name_old= $data['image_product'];

                if(!empty($location)){//jika filenya tidak kosong / ada file
                  //hapus file lama
                  if(file_exists("assets/image_product/$image_name_old")){                  
                    unlink("assets/image_product/$image_name_old");       
                  }
                  //masukan file baru
                  move_uploaded_file($location,"assets/image_product/$image_file");

                  //update db
                  $update= $conn->query("UPDATE product SET id_category='$category', name_product='$name_product', description_product='$description', price_product='$price',
                  stock_product='$stock', image_product='$image_file'
                  WHERE id_product = $id_product");
                  
                }
                else{//file tidak ada
                  //update db tanpa foto baru
                  $update= $conn->query("UPDATE product SET id_category='$category', name_product='$name_product', description_product='$description', price_product='$price',
                  stock_product='$stock'
                  WHERE id_product = $id_product");    
                }

                  if($update){
                    echo "<script>alert('Product berhasil di ubah!');</script>";
                    echo "<script>location='mProduct.php';</script>";
                  }
                  else{
                    echo $conn->error;
                  }
              }
            }
          ?>
          
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>
</html>