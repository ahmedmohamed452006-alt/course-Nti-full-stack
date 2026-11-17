<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

$query  = "SELECT * FROM `customers2` WHERE salary > 20000 ORDER BY salary DESC";
$result = mysqli_query($connection , $query);

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Customers with salary more than 20,000</h3>
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
</div>

<?php
require_once 'inc/footer.php';
?>
