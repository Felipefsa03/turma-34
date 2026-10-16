<?php

// ============================================
// AULA 07 - FUNDAMENTOS PHP: LAÇOS DE REPETIÇÃO (3.6)
// Na prática:
//   3.6.1 while
//   3.6.2 do-while
//   3.6.3 for
//   3.6.4 foreach
//   + break / continue, laços aninhados e acumuladores
// ============================================

// Ao abrir pelo navegador, preserva os espaços e quebras de linha.
if (PHP_SAPI !== 'cli') {
    echo "<pre>";
}


// --------------------------------------------
// 3.6.1 WHILE
// --------------------------------------------
// Testa a condição ANTES de executar.
// Pode não executar nenhuma vez, se a condição já começar falsa.

echo "=== 3.6.1 while ===\n";

$i = 1;
while ($i <= 5) {
    echo "Contando: $i\n";
    $i++;                 // sem o incremento, o laço NUNCA termina
}

echo "\n";


// --------------------------------------------
// 3.6.2 DO-WHILE
// --------------------------------------------
// Executa o bloco ANTES de testar.
// Executa ao menos UMA vez, mesmo com a condição falsa.

echo "=== 3.6.2 do-while ===\n";

$tentativa = 1;
do {
    echo "Tentativa $tentativa\n";
    $tentativa++;
} while ($tentativa <= 3);

// mesmo com a condição falsa de cara, roda uma vez:
$numero = 10;
do {
    echo "Roda uma vez mesmo com $numero > 5\n";
} while ($numero <= 5);

echo "\n";


// --------------------------------------------
// 3.6.3 FOR
// --------------------------------------------
// Ideal quando se sabe QUANTAS vezes repetir.
// Estrutura: for (início; condição; incremento)

echo "=== 3.6.3 for ===\n";

for ($i = 1; $i <= 5; $i++) {
    echo "Volta $i\n";
}

// Contagem regressiva
for ($i = 5; $i >= 1; $i--) {
    echo "$i...\n";
}
echo "Fim!\n";

// Tabuada do 7
echo "\nTabuada do 7:\n";
for ($i = 1; $i <= 10; $i++) {
    echo "7 x $i = " . (7 * $i) . "\n";
}

echo "\n";


// --------------------------------------------
// 3.6.4 FOREACH
// --------------------------------------------
// Percorre cada item de um array (ou objeto).
// Não precisamos controlar índice nem contador.

echo "=== 3.6.4 foreach ===\n";

$frutas = ["Maçã", "Banana", "Uva", "Laranja"];

foreach ($frutas as $fruta) {
    echo "Fruta: $fruta\n";
}

// Com a posição (chave) do array
echo "\nCom índice:\n";
foreach ($frutas as $indice => $fruta) {
    echo "$indice: $fruta\n";
}

echo "\n";


// --------------------------------------------
// BREAK e CONTINUE
// --------------------------------------------
// break    -> interrompe o laço por completo
// continue -> pula para a próxima repetição

echo "=== break e continue ===\n";

for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        break;              // para tudo no 5
    }
    echo "break  -> $i\n";
}

for ($i = 1; $i <= 5; $i++) {
    if ($i == 2 || $i == 4) {
        continue;           // "pula" os pares
    }
    echo "continue -> $i\n";
}

echo "\n";


// --------------------------------------------
// ACUMULADOR
// --------------------------------------------
// Padrão clássico: somar valores dentro do laço.

echo "=== Acumulador ===\n";

$notas = [7.5, 8.0, 6.5, 9.0];
$soma = 0;

foreach ($notas as $nota) {
    $soma += $nota;         // soma = soma + nota
}

$media = $soma / count($notas);
echo "Soma:  $soma\n";
echo "Média: " . number_format($media, 2) . "\n";

echo "\n";


// --------------------------------------------
// LAÇOS ANINHADOS
// --------------------------------------------
// Um laço dentro do outro (útil para linhas x colunas).

echo "=== Laços aninhados ===\n";

for ($linha = 1; $linha <= 3; $linha++) {
    for ($coluna = 1; $coluna <= 3; $coluna++) {
        echo "($linha,$coluna) ";
    }
    echo "\n";
}

echo "\n";


// --------------------------------------------
// LAÇO + CONDIÇÃO (FizzBuzz)
// --------------------------------------------
// Combina o que já sabemos de if/elseif com repetição.

echo "=== FizzBuzz (1 a 15) ===\n";

for ($i = 1; $i <= 15; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz\n";
    } elseif ($i % 3 == 0) {
        echo "Fizz\n";
    } elseif ($i % 5 == 0) {
        echo "Buzz\n";
    } else {
        echo "$i\n";
    }
}

echo "\n";


// --------------------------------------------
// ENTRADA + LAÇO (interativo)
// --------------------------------------------
// readline() só existe no terminal. Para não travar a execução,
// roda apenas com: php index.php input
if (PHP_SAPI === 'cli' && function_exists('readline') && in_array('input', $argv ?? [], true)) {
    echo "=== Entrada + laço (php index.php input) ===\n";

    $quantidade = (int) readline("Quantos nomes deseja cadastrar? ");
    $nomes = [];

    for ($i = 1; $i <= $quantidade; $i++) {
        $nomes[] = readline("Nome $i: ");
    }

    echo "\nNomes cadastrados:\n";
    foreach ($nomes as $indice => $nome) {
        echo ($indice + 1) . "º $nome\n";
    }
} else {
    echo "(Exemplo com readline() roda apenas com: php index.php input)\n";
}


if (PHP_SAPI !== 'cli') {
    echo "</pre>";
}
