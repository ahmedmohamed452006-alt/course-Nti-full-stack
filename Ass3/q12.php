<?php
// Q12
?>

<form method="POST">

    Product Price:
    <input type="number" name="price" step="any">

    <br><br>

    Quantity:
    <input type="number" name="quantity" step="1">

    <br><br>

    <button type="submit" name="submit">Calculate</button>

</form>

<?php

if (isset($_POST["submit"])) {

    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if (!is_numeric($price) || !is_numeric($quantity)) {

        echo "Please enter numbers";

    } elseif ($price < 0 || $quantity < 0) {

        echo "Negative numbers are not allowed";

    } else {

        $total = $price * $quantity;

        if ($total < 1000) {
            $discountRate = 10;
        } else {
            $discountRate = 15;
        }

        $discount = ($total * $discountRate) / 100;

        $finalPrice = $total - $discount;

        echo "Total Before Discount: " . $total . "<br>";

        echo "Discount: " . $discount . "<br>";

        echo "Total After Discount: " . $finalPrice;
    }
}

?>