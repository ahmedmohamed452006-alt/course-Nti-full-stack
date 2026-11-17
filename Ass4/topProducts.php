<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

$query = "SELECT products.name , SUM(orders.quantity) AS pieces , SUM(orders.quantity * products.price) AS profit
FROM products
JOIN orders ON orders.product_id = products.id
GROUP BY products.id , products.name
ORDER BY pieces DESC";
$result = mysqli_query($connection , $query);

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Top selling products</h3>
  <table class="table table-dark table-striped">
    <thead>
      <th>index</th>
      <th>product</th>
      <th>pieces sold</th>
      <th>earnings</th>
    </thead>
    <tbody>
<?php
$cont = 1;
while($row = mysqli_fetch_assoc($result)){
?>
      <tr>
        <td><?php echo $cont++ ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['pieces'] ?></td>
        <td><?php echo $row['profit'] ?></td>
      </tr>
<?php
}
?>
    </tbody>
  </table>
</div>

<?php
require_once 'inc/footer.php';
?>
