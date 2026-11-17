<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

$query = "SELECT customers2.id , customers2.name , COUNT(orders.id) AS orders_count
FROM customers2
LEFT JOIN orders ON orders.customer_id = customers2.id
GROUP BY customers2.id , customers2.name
ORDER BY orders_count DESC";
$result = mysqli_query($connection , $query);

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Number of orders for each customer</h3>
  <table class="table table-dark table-striped">
    <thead>
      <th>index</th>
      <th>name</th>
      <th>orders</th>
    </thead>
    <tbody>
<?php
$cont = 1;
while($row = mysqli_fetch_assoc($result)){
?>
      <tr>
        <td><?php echo $cont++ ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['orders_count'] ?></td>
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
