<?php
// Q9

$tests = array(1, "tariq", 1.5, true, 7, 's', false);

// For Loop

for ($i = 0; $i < count($tests); $i++) {

    if (is_bool($tests[$i])) {
        echo ($tests[$i] == true ? "Yes" : "No") . "<br>";
    } else {
        echo $tests[$i] . "<br>";
    }
}

echo "<hr>";

// While Loop

$i = 0;

while ($i < count($tests)) {

    if (is_bool($tests[$i])) {
        echo ($tests[$i] == true ? "Yes" : "No") . "<br>";
    } else {
        echo $tests[$i] . "<br>";
    }

    $i++;
}
?>