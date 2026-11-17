<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

$product = null;
$orders = null;
$customers = null;
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];

    //validation
    if(!is_numeric($id) || $id < 1 || $id != (int)$id){
        $error = "Product ID must be a positive number";
    }
    else{
        $id = (int)$id;
        $result  = mysqli_query($connection , "SELECT * FROM `products` WHERE id = $id");
        $product = mysqli_fetch_assoc($result);

        if(!$product){
            $error = "No product with this ID";
        }
        else{
            // orders that contain this product
            $orders = mysqli_query($connection , "SELECT id , quantity FROM `orders` WHERE product_id = $id ORDER BY id");

            // customers who bought it (highest salary first)
            $customers = mysqli_query($connection , "SELECT DISTINCT customers2.id , customers2.name , customers2.salary
            FROM customers2
            JOIN orders ON orders.customer_id = customers2.id
            WHERE orders.product_id = $id
            ORDER BY customers2.salary DESC");
        }
    }
}

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Product details</h3>

<?php if($error != ""){ ?>
  <div class="alert alert-danger"><?php echo $error ?></div>
<?php } ?>

  <form action="productDetails.php" method="post" class="d-flex gap-2 mb-3">
    <input type="number" name="id" class="form-control" placeholder="Product ID">
    <button type="submit" class="btn btn-primary">Show</button>
  </form>

<?php if($product){ ?>
  <div class="alert alert-secondary">
    <b><?php echo $product['name'] ?></b> was sold in <b><?php echo mysqli_num_rows($orders) ?></b> orders
  </div>

  <h5>Order numbers</h5>
  <p>
<?php
while($o = mysqli_fetch_assoc($orders)){
    echo "#" . $o['id'] . " ";
}
?>
  </p>

  <h5>Customers who bought it</h5>
  <table class="table table-dark table-striped">
    <thead>
      <th>index</th>
      <th>name</th>
      <th>salary</th>
    </thead>
    <tbody>
<?php
$cont = 1;
while($row = mysqli_fetch_assoc($customers)){
?>
      <tr>
        <td><?php echo $cont++ ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['salary'] ?></td>
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
