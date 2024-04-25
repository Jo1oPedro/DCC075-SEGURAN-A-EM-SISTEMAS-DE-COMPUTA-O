<?php

// Função para gerar um número pseudoaleatório
function geradorNumeroAleatorio(int $seed, int $m) {

    $xn = pow($seed, 2) % $m;
    $xn1 = pow($xn, 2) % $m;

    // Extrair o bit de paridade como saída
    $parityBit = $xn1 ^ $xn;

    // Atualizar a semente para a próxima iteração
    $seed = $xn1;

    return $parityBit;
}

// Definir p e q
$p = 15991;
$q = 90787;
$m = $p * $q;

// Verificar se p e q são congruentes a 3 módulo 4
if (($p % 4 != 3) || ($q % 4 != 3)) {
    die("Erro: p e q devem ser congruentes a 3 módulo 4");
}

// Definir a semente inicial
$seed = rand(1, $m - 1);

$randomBit = geradorNumeroAleatorio($seed, $m);
echo "p: {$p}" . PHP_EOL;
echo "q: {$q}" . PHP_EOL;
echo "seed: {$seed}" . PHP_EOL;
echo "Randombit: {$randomBit}" . PHP_EOL;
echo "bitstring: " . decbin($randomBit);

