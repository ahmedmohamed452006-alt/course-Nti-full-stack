<?php
require_once 'dbc.php';
if(!isset($_SESSION['user_id'])){
    $_SESSION['errors'] = "Please login first";
    header('location:login.php');
    exit();
}

// self join
$query = "SELECT emp.id , emp.name AS employee , IFNULL(mng.name , '-') AS manager
FROM employees emp
LEFT JOIN employees mng ON emp.manager_id = mng.id
ORDER BY emp.id";
$result = mysqli_query($connection , $query);

require_once 'inc/header.php';
require_once 'inc/nav.php';
require_once 'inc/errors.php';
?>

<div class="container my-4">
  <h3>Employees and their managers</h3>
  <table class="table table-dark table-striped">
    <thead>
      <th>id</th>
      <th>employee</th>
      <th>manager</th>
    </thead>
    <tbody>
<?php
while($row = mysqli_fetch_assoc($result)){
?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['employee'] ?></td>
        <td><?php echo $row['manager'] ?></td>
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
