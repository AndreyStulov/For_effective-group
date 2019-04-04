<?php

namespace Vendor_Andrey;

$a = 0;
$b = 1;
$c = 0;
$counter = 1;
echo "$a, $b, ";

do {
    $c = $a + $b;
    $a = $b;
    $b = $c;
    echo "$c, ";
    $counter++;
} while ($counter<64);

?>