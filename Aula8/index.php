<?php

// ============================================
// AULA 08 - FUNDAMENTOS PHP: ARRAYS, FUNÇÕES & PROJETO
//   3.7 Arrays (indexados, associativos e multidimensionais)
//   3.8 Funções (parâmetros, retorno, escopo e anônimas)
//   3.9 Strings
//   3.10 Funções nativas
//   3.11 Debugging
//   3.12 Projeto: calculadora + sistema de notas
//   + Getters e setters (encapsulamento)
// ============================================

// Ao abrir pelo navegador, preserva os espaços e quebras de linha.
if (PHP_SAPI !== 'cli') {
    echo "<pre>";
}

require __DIR__ . '/wagner.php';


// --------------------------------------------
// 3.7.1 ARRAYS INDEXADOS
// --------------------------------------------
// Cada item é acessado por um índice numérico que começa em 0.

echo "=== 3.7.1 Arrays indexados ===\n";

$linguagens = ["PHP", "JS", "Python"];

echo $linguagens[0] . "\n";        // PHP
echo $linguagens[2] . "\n";        // Python

$linguagens[] = "SQL";             // adiciona ao final
echo implode(", ", $linguagens) . "\n";
echo "Total: " . count($linguagens) . "\n";

foreach ($linguagens as $indice => $linguagem) {
    echo "$indice => $linguagem\n";
}

echo "\n";


// --------------------------------------------
// 3.7.2 ARRAYS ASSOCIATIVOS
// --------------------------------------------
// Usam chaves nomeadas (strings) em vez de índices numéricos.
// A sintaxe é "chave => valor".

echo "=== 3.7.2 Arrays associativos ===\n";

$aluno = [
    "nome"        => "Ana Silva",
    "curso"       => "Sistemas",
    "coeficiente" => 8.9,
];

echo $aluno["nome"] . "\n";          // Ana Silva
echo $aluno["coeficiente"] . "\n";   // 8.9

foreach ($aluno as $chave => $valor) {
    echo "$chave: $valor\n";
}

echo "\n";


// --------------------------------------------
// 3.7.3 ARRAYS MULTIDIMENSIONAIS (MATRIZES)
// --------------------------------------------
// Arrays que contêm outros arrays. Acesso: $matriz[linha][coluna].

echo "=== 3.7.3 Arrays multidimensionais ===\n";

$turma = [
    ["nome" => "Lucas", "nota" => 9.5],
    ["nome" => "Carla", "nota" => 7.0],
];

echo "Nota da Carla: " . number_format($turma[1]["nota"], 1) . "\n";   // 7.0

foreach ($turma as $estudante) {
    echo $estudante["nome"] . ": " . number_format($estudante["nota"], 1) . "\n";
}

echo "\n";


// --------------------------------------------
// 3.8.1-3.8.3 FUNÇÕES: declaração, parâmetros e argumentos
// --------------------------------------------
// Parâmetro  = variável na assinatura da função.
// Argumento  = valor real passado na chamada.

echo "=== 3.8.1-3.8.3 Funções ===\n";

function saudar(string $nome, string $titulo = "Sr(a)"): string
{
    return "Olá, $titulo $nome!";
}

echo saudar("Carlos") . "\n";          // usa o valor padrão
echo saudar("Elena", "Dra.") . "\n";   // passa os dois argumentos

echo "\n";


// --------------------------------------------
// 3.8.4-3.8.5 RETORNO E ESCOPO
// --------------------------------------------
// return   -> encerra a função e devolve um valor.
// Escopo   -> variável criada dentro da função é local.

echo "=== 3.8.4-3.8.5 Retorno e escopo ===\n";

$taxa = 1.1;   // escopo global

function calcularTotal(float $preco): float
{
    $imposto = 5.0;   // escopo local
    return $preco + $imposto;
}

echo "Total: " . calcularTotal(100) . "\n";
echo "Taxa global: $taxa\n";
// echo $imposto; // ❌ erro: $imposto não existe fora da função

echo "\n";


// --------------------------------------------
// 3.8.6 FUNÇÕES ANÔNIMAS E CLOSURES
// --------------------------------------------
// Função sem nome, guardada em variável.
// A cláusula "use" herda variáveis do escopo pai.

echo "=== 3.8.6 Funções anônimas e closures ===\n";

$desconto = 10;

$aplicarDesconto = function (float $valor) use ($desconto): float {
    return $valor - $desconto;
};

echo "Valor com desconto: " . $aplicarDesconto(100) . "\n";   // 90

echo "\n";


// --------------------------------------------
// 3.9 MANIPULAÇÃO DE TEXTO (STRINGS)
// --------------------------------------------
// Funções essenciais para tratar textos.

echo "=== 3.9 Strings ===\n";

$texto = "PHP e simples";

echo "strlen:       " . strlen($texto) . "\n";                 // 13
echo "strtoupper:   " . strtoupper($texto) . "\n";             // PHP E SIMPLES
echo "substr:       " . substr($texto, 0, 3) . "\n";           // PHP
echo "str_replace:  " . str_replace("simples", "poderoso", $texto) . "\n";

$csv = "maçã,banana,uva";
$frutas = explode(",", $csv);          // string -> array
echo "explode:      " . print_r($frutas, true);
echo "implode:      " . implode(" | ", $frutas) . "\n";   // array -> string

echo "\n";


// --------------------------------------------
// 3.10 FUNÇÕES NATIVAS ÚTEIS
// --------------------------------------------
echo "=== 3.10 Funções nativas ===\n";

$numeros = [4, 8, 2, 10];

echo "array_sum:  " . array_sum($numeros) . "\n";      // 24
echo "max:        " . max($numeros) . "\n";            // 10
echo "min:        " . min($numeros) . "\n";            // 2

sort($numeros);
echo "sort:       " . implode(", ", $numeros) . "\n";  // 2, 4, 8, 10

echo in_array(8, $numeros) ? "in_array:   8 está no array\n" : "in_array:   8 não está\n";

$dobrados = array_map(fn($n) => $n * 2, $numeros);
echo "array_map:  " . implode(", ", $dobrados) . "\n"; // 4, 8, 16, 20

echo "\n";


// --------------------------------------------
// 3.11 DEBUGGING
// --------------------------------------------
// var_dump mostra valor + tipo + tamanho.
// print_r mostra a estrutura de forma legível.

echo "=== 3.11 Debugging ===\n";

$dados = ["PHP", 8, true];

echo "var_dump:\n";
var_dump($dados);

echo "print_r:\n";
print_r($dados);

echo "\n";


// --------------------------------------------
// GETTERS E SETTERS (ENCAPSULAMENTO)
// --------------------------------------------
// A classe Wagner (wagner.php) guarda nota e presença como "private".
// O acesso é feito por getNota()/setNota() e getPresenca()/setPresenca().

echo "=== Getters e setters ===\n";

$estudante = new Wagner();
$estudante->setNota(8.5);
$estudante->setPresenca(80);   // aceita 80 (porcentagem)

echo "Nota:     " . $estudante->getNota() . "\n";
echo "Presença: " . $estudante->getPresencaFormatada() . "\n";
echo "Situação: " . $estudante->condicao() . "\n";

// A linha abaixo daria erro, porque a propriedade é privada:
// echo $estudante->nota;

echo "\n";


// --------------------------------------------
// 3.12 PROJETO: CALCULADORA + SISTEMA DE NOTAS
// --------------------------------------------
echo "=== 3.12 Projeto: calculadora + notas ===\n";

function somar(float $a, float $b): float
{
    return $a + $b;
}

function subtrair(float $a, float $b): float
{
    return $a - $b;
}

function multiplicar(float $a, float $b): float
{
    return $a * $b;
}

function dividir(float $a, float $b): float
{
    if ($b == 0) {
        throw new InvalidArgumentException("Não é possível dividir por zero.");
    }

    return $a / $b;
}

function media(array $notas): float
{
    if (count($notas) === 0) {
        throw new InvalidArgumentException("Informe pelo menos uma nota.");
    }

    return array_sum($notas) / count($notas);
}

function situacao(float $media, float $presenca): string
{
    if ($media >= 7 && $presenca >= 0.75) {
        return "Aprovado";
    }

    if ($media >= 5 && $presenca >= 0.75) {
        return "Recuperação";
    }

    return "Reprovado";
}

echo "10 + 5 = " . somar(10, 5) . "\n";
echo "10 - 5 = " . subtrair(10, 5) . "\n";
echo "10 * 5 = " . multiplicar(10, 5) . "\n";
echo "10 / 5 = " . dividir(10, 5) . "\n";

$notas = [8.5, 7.0, 9.0];
$mediaFinal = media($notas);

echo "Média:   " . number_format($mediaFinal, 2) . "\n";
echo "Situação: " . situacao($mediaFinal, 0.80) . "\n";

echo "\n";


// --------------------------------------------
// MENU INTERATIVO (terminal)
// --------------------------------------------
// Roda apenas com: php index.php input
if (PHP_SAPI === 'cli' && function_exists('readline') && in_array('input', $argv ?? [], true)) {
    echo "=== Menu interativo ===\n";

    $opcao = 0;

    while ($opcao != 4) {
        echo "\n1 - Somar\n";
        echo "2 - Subtrair\n";
        echo "3 - Média de notas\n";
        echo "4 - Sair\n";

        $opcao = (int) readline("Escolha: ");

        switch ($opcao) {
            case 1:
                $a = (float) readline("Primeiro número: ");
                $b = (float) readline("Segundo número: ");
                echo "Resultado: " . somar($a, $b) . "\n";
                break;

            case 2:
                $a = (float) readline("Primeiro número: ");
                $b = (float) readline("Segundo número: ");
                echo "Resultado: " . subtrair($a, $b) . "\n";
                break;

            case 3:
                $entrada = readline("Notas separadas por vírgula: ");
                $notasLidas = array_map('floatval', explode(",", $entrada));
                echo "Média: " . number_format(media($notasLidas), 2) . "\n";
                break;

            case 4:
                echo "Até mais!\n";
                break;

            default:
                echo "Opção inválida!\n";
        }
    }
} else {
    echo "(O menu interativo roda com: php index.php input)\n";
}


if (PHP_SAPI !== 'cli') {
    echo "</pre>";
}
