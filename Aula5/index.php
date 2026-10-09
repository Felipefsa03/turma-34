<?php

// ============================================
// AULA 05 - FUNDAMENTOS PHP: REVISÃO + LAÇOS (NN FOI TODOS)
//   3.1 Saída de dados
//   3.2 Variáveis, constantes e operadores
//   3.3 Tipos de dados e coerção
//   3.4 Entrada de dados
//   3.5 Estruturas condicionais
//   3.6 Estruturas de repetição (while, do-while, for, foreach)
// ============================================

// Ao abrir pelo navegador, preserva os espaços e quebras de linha, ou seja, ignorem essa linha
if (PHP_SAPI !== 'cli') {
    echo "<pre>";
}


// --------------------------------------------
// 3.1 SAÍDA DE DADOS
// --------------------------------------------
// Formas de exibir informação no navegador ou no terminal.

echo "=== 3.1 Saída de dados ===\n";

echo "echo: Olá, mundo!\n";        // saída comum
print "print: Bem-vindo!\n";        // saída com valor de retorno (1)

$dados = ["PHP", 8];
print_r($dados);                    // visualização legível de arrays
var_dump($dados);                   // tipo e valor dos dados

echo "\n";


// --------------------------------------------
// 3.2 VARIÁVEIS E CONSTANTES
// --------------------------------------------
// Variáveis começam com $ e diferenciam maiúsculas/minúsculas.
// Constantes são definidas uma vez e não podem ser reatribuídas.

echo "=== 3.2 Variáveis e constantes ===\n";

$nome = "Maria";
$idade = 20;
echo "$nome tem $idade anos.\n";

define("PI", 3.14159);              // constante com define()
const URL = "meusite.com";          // constante com const

echo "PI = " . PI . "\n";
echo "URL = " . URL . "\n";

echo "\n";


// --------------------------------------------
// 3.2 OPERADORES
// --------------------------------------------
// Aritméticos, de comparação e lógicos.

echo "=== 3.2 Operadores ===\n";

$a = 10;
$b = 3;

echo "Soma:        " . ($a + $b) . "\n";   // 13
echo "Subtração:   " . ($a - $b) . "\n";   // 7
echo "Multiplicação: " . ($a * $b) . "\n"; // 30
echo "Divisão:     " . ($a / $b) . "\n";   // 3.33...
echo "Resto:       " . ($a % $b) . "\n";   // 1

var_dump($a == $b);   // false — mesmo valor?
var_dump($a === $b);  // false — mesmo valor E tipo?
var_dump($a > $b);    // true

var_dump($a > 5 && $b < 5);   // true  (E)
var_dump($a < 5 || $b < 5);   // true  (OU)
var_dump(!($a > 5));          // false (NÃO)

echo "\n";


// --------------------------------------------
// 3.3 TIPOS DE DADOS E COERÇÃO
// --------------------------------------------
// O PHP identifica o tipo durante a execução (tipagem dinâmica).

echo "=== 3.3 Tipos de dados e coerção ===\n";

$nome = "Maria";    // string
$idade = 20;        // int
$preco = 12.5;      // float
$ativo = true;      // bool

var_dump($nome, $idade, $preco, $ativo);

// Coerção automática: "10" vira 10 na soma
$soma = "10" + 5;
var_dump($soma);    // int(15)

// Coerção forçada (casting)
$numero = (int) "10";
var_dump($numero);  // int(10)

var_dump((float) "12.5");  // float(12.5)
var_dump((string) 123);    // string(3) "123"

echo "\n";


// --------------------------------------------
// 3.4 ENTRADA DE DADOS
// --------------------------------------------
// Web: $_GET (URL) e $_POST (corpo da requisição).
// CLI : readline() captura o texto digitado.

echo "=== 3.4 Entrada de dados ===\n";

$nomeGet = $_GET["nome"] ?? "Visitante";
$emailPost = $_POST["email"] ?? "";

echo "GET  nome: $nomeGet\n";
echo "POST email: " . ($emailPost !== "" ? $emailPost : "(vazio)") . "\n";

// readline() só existe no terminal. Para não travar a execução,
// o exemplo interativo roda apenas com: php index.php input
if (PHP_SAPI === 'cli' && function_exists('readline') && in_array('input', $argv ?? [], true)) {
    $nomeCli = readline("Digite seu nome: ");
    echo "Olá, $nomeCli!\n";
} else {
    echo "(Exemplo de readline() rodando apenas com: php index.php input)\n";
}

echo "\n";


// --------------------------------------------
// 3.5.1 CONDICIONAIS - if / elseif / else
// --------------------------------------------
echo "=== 3.5.1 if, elseif e else ===\n";

$idade = 17;

if ($idade >= 18) {
    echo "Maior de idade\n";
} elseif ($idade == 17) {
    echo "Quase lá!\n";
} else {
    echo "Menor de idade\n";
}

echo "\n";


// --------------------------------------------
// 3.5.2 CONDICIONAIS - switch
// --------------------------------------------
// Compara uma expressão com vários casos fixos.
// O break interrompe o fluxo; o default trata o caso restante.

echo "=== 3.5.2 switch ===\n";

$opcao = 2;

switch ($opcao) {
    case 1:
        echo "Opção 1\n";
        break;
    case 2:
        echo "Opção 2\n";
        break;
    default:
        echo "Inválido\n";
}

echo "\n";


// --------------------------------------------
// 3.5.3 OPERADOR TERNÁRIO
// --------------------------------------------
// condição ? verdadeiro : falso

echo "=== 3.5.3 Operador ternário ===\n";

$nota = 8;
$status = ($nota >= 7) ? "Aprovado" : "Reprovado";
echo $status . "\n";

echo "\n";


// --------------------------------------------
// 3.6 ESTRUTURAS DE REPETIÇÃO
// --------------------------------------------
// Laços permitem repetir um bloco de instruções de forma controlada.

echo "=== 3.6.1 while ===\n";

$i = 1;
while ($i <= 5) {      // verifica antes: pode não executar
    echo $i;
    $i++;
}
echo "\n";

echo "=== 3.6.1 do-while ===\n";

$j = 1;
do {                   // verifica depois: executa ao menos uma vez
    echo $j;
    $j++;
} while ($j <= 5);
echo "\n";

echo "=== 3.6.2 for ===\n";

for ($k = 1; $k <= 10; $k++) {
    echo "Número: $k\n";
}

// Tabuada do 3 com for
echo "Tabuada do 3:\n";
for ($n = 1; $n <= 10; $n++) {
    echo "3 x $n = " . (3 * $n) . "\n";
}

echo "\n";

echo "=== 3.6.3 foreach ===\n";

$frutas = ["Maçã", "Banana", "Laranja"];

foreach ($frutas as $fruta) {
    echo "Eu gosto de $fruta\n";
}

// Com chave e valor
$aluno = ["nome" => "Maria", "idade" => 20, "curso" => "PHP"];

foreach ($aluno as $chave => $valor) {
    echo "$chave: $valor\n";
}

echo "\n";


if (PHP_SAPI !== 'cli') {
    echo "</pre>";
}
