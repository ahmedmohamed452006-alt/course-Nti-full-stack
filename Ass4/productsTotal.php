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
    $number = $_POST['number'];

    //validation
    if(!is_numeric($number) || $number != (int)$number || $number < 100 || $number > 5000){
        $error = "Number must be between 100 and 5000";
    }
    else{
        $number = (int)$number;
        $query = "SELECT products.name , SUM(orders.quantity) AS total
        FROM products
        JOIN orders ON orders.product_id = products.id
        GROUP BY products.id , products.name
        HAVING total > $number
        ORDER BY total DESC";
        $result = mysqli_query($connection , $query);
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Products with total pieces more than a number</h3>

<?php if($error != ""){ ?>
  <div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

  <form action="productsTotal.php" method="post" class="d-flex gap-2 mb-3">
    <input type="number" name="number" class="form-control" placeholder="100 - 5000">
    <button type="submit" class="btn btn-primary">Show</button>
  </form>

<?php if($result){ ?>
  <table class="table table-dark table-striped">
    <thead>
      <th>index</th>
      <th>product</th>
      <th>total pieces</th>
    </thead>
    <tbody>
<?php
$cont = 1;
while($row = mysqli_fetch_assoc($result)){
?>
      <tr>
        <td><?php echo $cont++ ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['total'] ?></td>
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
