<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">MySQL Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="home.php">Home</a>
        </li>
<?php
if(isset($_SESSION['user_id'])){
?>
        <li class="nav-item"><a class="nav-link" href="customers.php">Rich Customers</a></li>
        <li class="nav-item"><a class="nav-link" href="selectOne.php">Customer By ID</a></li>
        <li class="nav-item"><a class="nav-link" href="ordersCount.php">Orders Count</a></li>
        <li class="nav-item"><a class="nav-link" href="topProducts.php">Top Products</a></li>
        <li class="nav-item"><a class="nav-link" href="employees.php">Employees</a></li>
        <li class="nav-item"><a class="nav-link" href="searchName.php">Search Name</a></li>
        <li class="nav-item"><a class="nav-link" href="byCity.php">By City</a></li>
        <li class="nav-item"><a class="nav-link" href="productsTotal.php">Products Total</a></li>
        <li class="nav-item"><a class="nav-link" href="topCity.php">Top 3 In City</a></li>
        <li class="nav-item"><a class="nav-link" href="productDetails.php">Product Details</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
<?php
}else{
?>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
<?php
}
?>
      </ul>
    </div>
  </div>
</nav>
