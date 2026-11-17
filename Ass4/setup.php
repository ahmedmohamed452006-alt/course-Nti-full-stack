<?php
// RUN ONCE in the browser then DELETE this file
require_once 'dbc.php';

mysqli_query($connection , "DROP TABLE IF EXISTS orders");
mysqli_query($connection , "DROP TABLE IF EXISTS products");
mysqli_query($connection , "DROP TABLE IF EXISTS employees");

mysqli_query($connection , "CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL
)");
mysqli_query($connection , "CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL
)");
mysqli_query($connection , "CREATE TABLE employees (
  id INT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  manager_id INT NULL
)");

mysqli_query($connection , "INSERT INTO products (name , price) VALUES
 ('Milk',10),('Orange',12),('Bread',5),('Cheese',40),
 ('Eggs',25),('Rice',30),('Sugar',22),('Tea',35)");

mysqli_query($connection , "INSERT INTO employees (id , name , manager_id) VALUES
 (1,'Mohamed Ali',NULL),(2,'Sara Hassan',1),(3,'Omar Khaled',1),
 (4,'Nada Samir',2),(5,'Youssef Adel',2),(6,'Mona Ibrahim',3),
 (7,'Karim Fathy',3),(8,'Hana Tarek',4),(9,'Ali Hossam',5),(10,'Laila Mostafa',6)");

// 1000 random orders from real customers
$ids = [];
$res = mysqli_query($connection , "SELECT id FROM customers2");
while($r = mysqli_fetch_assoc($res)){
    $ids[] = $r['id'];
}
$vals = [];
for($i = 0; $i < 1000; $i++){
    $cid = $ids[array_rand($ids)];
    $vals[] = "(" . $cid . "," . rand(1,8) . "," . rand(1,20) . ")";
}
mysqli_query($connection , "INSERT INTO orders (customer_id , product_id , quantity) VALUES " . implode(',' , $vals));

// only 5 cities
mysqli_query($connection , "UPDATE customers2 SET city = ELT(1 + (id % 5) , 'Cairo','Giza','Alex','Aswan','Luxor')");

// password 123456 for customers without password
$hash = password_hash('123456' , PASSWORD_DEFAULT);
mysqli_query($connection , "UPDATE customers2 SET password = '$hash' WHERE password IS NULL OR password = ''");

echo "Done. Login with any customer email and password 123456. Now DELETE setup.php";
