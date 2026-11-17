<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

$customer = null;
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];

    //validation
    if(!is_numeric($id) || $id < 1 || $id != (int)$id){
        $error = "ID must be a positive number";
    }
    else{
        $id = (int)$id;
        $query  = "SELECT * FROM `customers2` WHERE id = $id";
        $result = mysqli_query($connection , $query);
        $customer = mysqli_fetch_assoc($result);
        if(!$customer){
            $error = "No customer with this ID";
        }
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Customer By ID</h3>

<?php if($error != ""){ ?>
  <div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

  <form action="selectOne.php" method="post" class="d-flex gap-2 mb-3">
    <input type="number" name="id" class="form-control" placeholder="Customer ID">
    <button type="submit" class="btn btn-primary">Show</button>
  </form>

<?php if($customer){ ?>
  <table class="table table-dark table-striped">
    <thead>
      <th>id</th>
      <th>name</th>
      <th>email</th>
      <th>salary</th>
      <th>city</th>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $customer['id'] ?></td>
        <td><?php echo $customer['name'] ?></td>
        <td><?php echo $customer['email'] ?></td>
        <td><?php echo $customer['salary'] ?></td>
        <td><?php echo $customer['city'] ?></td>
      </tr>
    </tbody>
  </table>
<?php } ?>
</div>

<?php
require_once 'inc/footer.php';
?>
