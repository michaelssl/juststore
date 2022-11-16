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
  <title>Add Product</title>
</head>
<body>
<?php include 'navbar.php'; ?>

  <div class="container"> 
  
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <h1>JustStore</h1>
        <div class="card">
          <h4 class="card-header">Add Product</h4>
          <div class="card-body">

          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Product Name" name="name" required>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" rows="3" name="description" placeholder="Description product" required></textarea>
            </div>
            <div class="form-group">
              <label for="Price">Price</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="text" id="stock" class="form-control" placeholder="Min 0 " name="stock" required>
            </div>
            <div class="form-group">
              <label for="image">Product Photo</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" id="category" name="category">
                <?php 
                $category_data =$conn->query("SELECT * FROM category ORDER BY name_category");
                while($data= $category_data->fetch_assoc()){
                ?>
                <option value="<?php echo $data['id_category'] ?>"><?php echo $data['name_category']; ?></option>
                <?php } ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add Product</button>
          </form>
            
          <?php 
            if(isset($_POST['add'])){
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
              else if($extensionImg !== 'jpg' AND $extensionImg !== 'jpeg' AND $extensionImg !=='png'){
                echo "<script>alert('extension file harus jpg, jpeg, png atau file tidak boleh kosong');</script>";
              }
              else if($sizeImg > 2000000){
                echo "<script>alert('max ukuran file 2mb');</script>";
              }
              else{//valid
                $image_name= $_FILES['image']['name'];
                $location = $_FILES['image']['tmp_name'];
                $image_file= date('YmdHis') . $image_name;

                //pindah file yg diupload
                move_uploaded_file($location,"assets/image_product/$image_file");

                //masukan ke database
                $insert = $conn->query("INSERT INTO product (id_category,name_product,description_product,
                price_product,stock_product,image_product)VALUES('$category','$name_product','$description',
                '$price','$stock','$image_file')");

                  if($insert){
                    echo "<script>alert('Product berhasil di tambahkan');</script>";
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