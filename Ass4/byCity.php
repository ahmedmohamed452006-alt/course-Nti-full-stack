<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

// all cities for the select
$citiesResult = mysqli_query($connection , "SELECT DISTINCT city FROM `customers2` WHERE city <> '' ORDER BY city");
$cities = [];
while($c = mysqli_fetch_assoc($citiesResult)){
    $cities[] = $c['city'];
}

$result = null;
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $city = $_POST['city'];

    //validation
    if(!in_array($city , $cities)){
        $error = "Please choose a valid city";
    }
    else{
        $city = mysqli_real_escape_string($connection , $city);
        $query  = "SELECT * FROM `customers2` WHERE city = '$city' ORDER BY name";
        $result = mysqli_query($connection , $query);
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Customers by city</h3>

<?php if($error != ""){ ?>
  <div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

  <form action="byCity.php" method="post" class="d-flex gap-2 mb-3">
    <select name="city" class="form-select">
      <option value="">Choose city</option>
<?php foreach($cities as $city_name){ ?>
      <option value="<?php echo $city_name ?>"><?php echo $city_name ?></option>
<?php } ?>
    </select>
    <button type="submit" class="btn btn-primary">Submit</button>
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
