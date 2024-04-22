<?php

// Função para calcular exponenciação modular
function expModular($base, $exp, $mod) {
    $result = 1;
    $base = $base % $mod;

    while ($exp > 0) {
        if ($exp % 2 == 1) {
            $result = ($result * $base) % $mod;
        }
        $exp = $exp >> 1;
        $base = ($base * $base) % $mod;
    }

    return $result;
}

$p = 104729;
$g = 12;
// Gerando chaves privadas aleatórias para Alice e Bob
$a = rand(2, $p - 2);
$b = rand(2, $p - 2);

// Calculando chaves públicas de Alice e Bob
$A = expModular($g, $a, $p);
$B = expModular($g, $b, $p);

// Calculando segredos compartilhados de Alice e Bob
$secretA = expModular($B, $a, $p);
$secretB = expModular($A, $b, $p);

// Imprimindo os valores
echo "p: $p\n";
echo "g: $g\n";
echo "Chave privada de Alice (a): $a\n";
echo "Chave privada de Bob (b): $b\n";
echo "Chave pública de Alice (A): $A\n";
echo "Chave pública de Bob (B): $B\n";
echo "Segredo compartilhado de Alice: $secretA\n";
echo "Segredo compartilhado de Bob: $secretB\n";

?>
