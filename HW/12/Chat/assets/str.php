<?php

function str_random(int $len) : string {
    $str = '';
    foreach (range(0, $len) as $i) {
        $cap = rand(0, 1);
        $str .= chr(rand(ord('a'), ord('z')) - $cap * (ord('a') - ord('A')));
    }
    return $str;
}