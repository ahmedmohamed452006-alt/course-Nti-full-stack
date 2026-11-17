<?php
if(isset($_SESSION['errors'])){
?>
<div class="alert alert-danger"><?php echo $_SESSION['errors'] ?></div>
<?php
}
unset($_SESSION['errors']);
?>

<?php
if(isset($_SESSION['success'])){
?>
<div class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
<?php
}
unset($_SESSION['success']);
?>
