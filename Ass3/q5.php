<?php

function RouteBubble($arr) {

    $n = count($arr);

    for ($i = 0; $i < $n - 1; $i++) {

        for ($j = 0; $j < $n - $i - 1; $j++) {

            if ($arr[$j] > $arr[$j + 1]) {

                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;

            }
        }
    }

    return $arr;
}

$numbers = array(6, 4, 9, 3, 12, 8, 7);

$result = RouteBubble($numbers);

echo implode(" ", $result);
?>