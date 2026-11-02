<?php

$arr1 = array('a', 'b', 'c', 'd');
$arr2 = array('c', 'd', 'e', 'f');

foreach ($arr1 as $value) {

    if (in_array($value, $arr2)) {
        echo $value . "-";
    }
}
?>