<?php
require_once 'dbc.php';
if(isset($_SESSION['user_id'])){
    header('location:home.php');
    exit();
}
require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<h2 class="text-center my-3">Register</h2>

<div class="container my-2">
  <form class="w-75 m-auto" action="handle/handleRegister.php" method="post">
    <div class="mb-3">
      <label class="form-label">user name</label>
      <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">email</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Register</button>
  </form>
</div>

<?php
require_once 'inc/footer.php';
?>
