<?php


function calculate($num1, $num2) {
    echo "Multiplication = " . ($num1 * $num2) . "<br>";
    echo "Difference = " . ($num1 - $num2) . "<br>";

    if ($num2 != 0) {
        echo "Division = " . ($num1 / $num2);
    } else {
        echo "Cannot divide by zero";
    }
}

calculate(10, 5);
?>