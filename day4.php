<?php

// Can be made faster because when you encounter a lower value, all values within that range can be skipped.
// I will not bother now ;)

$start = 136818;
$end = 685979;
$possiblePasswords = 0;

for ($i = $start; $i <= $end; $i++) {
    $double = false;
    $increase = true;
    $largerGroup = false;
    $code = array_map('intval', str_split($i));
    $lastDigit = null;
    $repeatCount = 1;
    for ($num = 0; $num < 6; $num++) {
        if ($num > 0 && $num < 5) {
            if ($code[$num-1] > $code[$num] || $code[$num+1] < $code[$num]) {
                $increase = false;
            }
            if ($code[$num-1] == $code[$num] && $code[$num+1] == $code[$num]) {
                $largerGroup = true;
            }
        }
        if ($lastDigit == null) {
            $lastDigit = $code[$num];
        } else {
            if ($lastDigit == $code[$num]) {
                $repeatCount++;
            } else {
                if ($repeatCount == 2) {// double found
                    $double = true;
                }
                $repeatCount = 1;
            }
            $lastDigit = $code[$num];
        }
        if ($num == 5 && $repeatCount == 2) {
            $double = true;
        }
        
    }
    if ($double && $increase && (!$largerGroup || $double)) {
        $possiblePasswords++;
    }
}

echo $possiblePasswords;
