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
    $city = trim($_POST['city']);

    //validation
    if(strlen($city) < 1 || strlen($city) > 50){
        $error = "City must be 1-50 characters";
    }
    else{
        $city = mysqli_real_escape_string($connection , $city);
        $query  = "SELECT * FROM `customers2` WHERE city = '$city' ORDER BY salary DESC LIMIT 3";
        $result = mysqli_query($connection , $query);
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Top 3 salaries in a city</h3>

<?php if($error != ""){ ?>
  <div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

  <form action="topCity.php" method="post" class="d-flex gap-2 mb-3">
    <input type="text" name="city" class="form-control" placeholder="City name (Cairo,....)">
    <button type="submit" class="btn btn-primary">Show</button>
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
