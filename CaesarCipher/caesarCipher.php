<?php

require_once __DIR__ . "/vendor/autoload.php";

echo "Enter the phrase: ";
$phrase = readline();

echo "Enter the k: ";
$k = readline();

$newPhrase = "";
$phraseLenght = strlen($phrase);
$lettersFrequency = [];
for($count = 0; $count < $phraseLenght; $count++) {
    for($countK = 0; $countK < $k; $countK++) {
        $letter = $phrase[$count];
        $newPhrase[$count] = (strlen(++$letter) > 0) ? $letter[0] : $letter;
    }
    if(!isset($lettersFrequency[$phrase[$count]])) {
        $lettersFrequency[$phrase[$count]] = 1;
        continue;
    }
    $lettersFrequency[$phrase[$count]]++;
}

foreach($lettersFrequency as $key => $letterFrequency) {
    $lettersFrequency[$key] = $letterFrequency / $phraseLenght;
}

echo "Frequencia de Letras: " . PHP_EOL;
var_dump($lettersFrequency);


echo PHP_EOL . "Frase criptografa: " . $newPhrase;