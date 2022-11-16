<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-0 h1  mr-auto" href="index.php">JustStore</a>
      
      <ul class="navbar-nav">

      <?php if(isset($_SESSION['member'])): ?>
      <!-- Cart -->
      <a href="productcart.php" class="btn btn-warning ml-2 mr-2">Cart
          <?php 
            if(!empty($_SESSION['cart'])): //jika cart tidak kosong atau ada?>
            <span class="badge badge-danger"> 
              <?php echo count($_SESSION['cart']); ?> 
            </span>
            <?php endif; ?>
        </a>
      
      
        <?php $role = $_SESSION['member']['role_member']; ?>
          <?php if($role=='staff' OR $role == 'admin'):  ?>
        <!-- Manage --> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Manage
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="mcourier.php">Manage Courier</a>
            <a class="dropdown-item" href="mcategory.php">Manage Category</a>
            <a class="dropdown-item" href="mproduct.php">Manage Product</a>
          <?php endif; ?>
            <?php if($role == 'admin'): ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="mstaffadmin.php">Manage Staff/Admin</a>
            <a class="dropdown-item" href="mslider.php">Manage Slider</a>
            <?php endif; ?>
          </div>
        </li>
        <!-- Profile -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="assets/image_profile/<?php echo $_SESSION['member']['image_member'] ?>" alt="profile" width="25px">
            <?php echo $_SESSION['member']['name_member']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="history.php">Shopping History</a>
            <a class="dropdown-item" href="profile.php">My Profile</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
        <?php endif; ?>
        

        <li <?php if(isset($_SESSION['member'])) echo 'style="display: none;"'; ?>><a href="login.php" class="btn btn-primary mr-sm-2 ml-sm-2">Login</a></li>
        <li <?php if(isset($_SESSION['member'])) echo 'style="display: none;"'; ?>><a href="register.php" class="btn btn-primary">Register</a></li>

      <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
        <input class="form-control mr-sm-2 ml-2" type="search" placeholder="Search Product" aria-label="Search"
        name="keyword">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
      </ul>
  </nav>