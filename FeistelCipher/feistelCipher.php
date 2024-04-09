<?php

// S_BOX para encriptação DES
const S_BOX = [
    [14, 4, 13, 1, 2, 15, 11, 8, 3, 10, 6, 12, 5, 9, 0, 7],
    [0, 15, 7, 4, 14, 2, 13, 1, 10, 6, 12, 11, 9, 5, 3, 8],
    [4, 1, 14, 8, 13, 6, 2, 11, 15, 12, 9, 7, 3, 10, 5, 0],
    [15, 12, 8, 2, 4, 9, 1, 7, 5, 11, 3, 14, 10, 0, 6, 13],
    [15, 1, 8, 14, 6, 11, 3, 4, 9, 7, 2, 13, 12, 0, 5, 10],
    [3, 13, 4, 7, 15, 2, 8, 14, 12, 0, 1, 10, 6, 9, 11, 5],
    [0, 14, 7, 11, 10, 4, 13, 1, 5, 8, 12, 6, 9, 3, 2, 15],
    [13, 8, 10, 1, 3, 15, 4, 2, 11, 6, 7, 12, 0, 5, 14, 9],
];

// Função f para permutação
function f(int $block, int $key, array $s_box): int {
    $output = 0;
    for ($count = 0; $count < 8; $count++) {
        $row = ($block >> ($count * 4)) & 0xF;
        $col = ($key >> ($count * 4)) & 0xF;
        $output |= ($s_box[$count][$row ^ $col] << ($count * 4));
    }
    return $output;
}

// Function for Feistel cipher encryption
function feistel_encrypt(int $plaintext, array $keys, array $s_box): int {
    $left = ($plaintext >> 32) & 0xFFFFFFFF;
    $right = $plaintext & 0xFFFFFFFF;

    for ($count = 0; $count < 16; $count++) {
        $temp = $right;
        $right = $left ^ f($right, $keys[$count], $s_box);
        $left = $temp;
    }

    return ($left << 32) | $right;
}

$text = 0x0123456789ABCDEF;
$keys = [
    0x00000000, 0x11111111, 0x22222222, 0x33333333, 0x44444444, 0x55555555, 0x66666666,
    0x77777777, 0x88888888, 0x99999999, 0xAAAAAAAA, 0xBBBBBBBB, 0xCCCCCCCC, 0xDDDDDDDD,
    0xEEEEEEEE, 0xFFFFFFFF,
];

$ciphertext = feistel_encrypt($text, $keys, S_BOX);

printf("Text: %016X\n", $text);
printf("Ciphertext: %016X\n", $ciphertext);

?>
