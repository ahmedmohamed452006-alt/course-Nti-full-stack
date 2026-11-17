<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

$result = null;
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = trim($_POST['name']);

    //validation
    if(strlen($name) < 1 || strlen($name) > 50){
        $error = "Name must be 1-50 characters";
    }
    else{
        $name = mysqli_real_escape_string($connection , $name);
        $query  = "SELECT * FROM `customers2` WHERE name LIKE '%$name%' ORDER BY name";
        $result = mysqli_query($connection , $query);
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Search customers by name</h3>

<?php if($error != ""){ ?>
  <div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

  <form action="searchName.php" method="post" class="d-flex gap-2 mb-3">
    <input type="text" name="name" class="form-control" placeholder="Customer name">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>

<?php if($result){ ?>
  <table class="table table-dark table-striped">
    <thead>
      <th>index</th>
      <th>name</th>
      <th>email</th>
      <th>salary</th>
      <th>city</th>
    </thead>
    <tbody>
<?php
$cont = 1;
while($row = mysqli_fetch_assoc($result)){
?>
      <tr>
        <td><?php echo $cont++ ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['salary'] ?></td>
        <td><?php echo $row['city'] ?></td>
      </tr>
<?php
}
?>
    </tbody>
  </table>
<?php } ?>
</div>

<?php
require_once 'inc/footer.php';
?>
