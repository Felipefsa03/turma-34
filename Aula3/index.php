<?php

// ============================================
// AULA 03 - FUNDAMENTOS PHP
// Saída de dados, Variáveis, Tipos e Estruturas Condicionais
// ============================================

// --------------------------------------------
// CONSTANTES (definidas antes do uso)
// --------------------------------------------

define("PI", 3.14);
const URL_SITE = "https://www.google.com.br";

// --------------------------------------------
// 3.1 SAÍDA DE DADOS
// --------------------------------------------

// echo: principal construtor para imprimir textos e variáveis.
echo "Olá, Mundo!";

// print: similar ao echo, mas sempre retorna 1.
print "Primeira aula de PHP.";

// Variaveis (distintas)
$pipipi = "pipipi";
$popopo = "popopo";

// Concatenação com ponto (.)
echo $pipipi . " " . $popopo;

echo "\n";

// print_r(): inspeção detalhada de arrays e objetos.
print_r(URL_SITE);

// var_dump(): mostra tipo e valor com mais detalhe.
var_dump($pipipi);

echo "\n";


// --------------------------------------------
// 3.2 MEMÓRIA - VARIÁVEIS E CONSTANTES
// --------------------------------------------

// Variáveis: iniciam sempre com o cifrão ($)
// São case-sensitive (diferenciam maiúsculas e minúsculas).
$idade = 25;
$Idade = 30;

$nome = "Maria";
$temCNH = true;

echo "Idade (minuscula): $idade";
echo "\n";
echo "Idade (maiuscula): $Idade";
echo "\n";

echo "Constante PI: " . PI;
echo "\n";
echo "Constante URL_SITE: " . URL_SITE;
echo "\n";

// gettype() mostra o tipo do valor.
echo "Tipo de \$idade: " . gettype($idade);
echo "\n";
echo "Tipo de \$nome: " . gettype($nome);
echo "\n";

// --------------------------------------------
// 3.3 OPERADORES - ARITMÉTICOS
// --------------------------------------------

$a = 10;
$b = 20;

echo "Aritméticos";
echo "\n";
echo "Soma: " . ($a + $b);
echo "\n";
echo "Subtração: " . ($b - $a);
echo "\n";
echo "Multiplicação: " . ($a * $b);
echo "\n";
echo "Divisão: " . ($b / $a);
echo "\n";
echo "Módulo (resto): " . ($b % $a);
echo "\n";
echo "Exponenciação: " . ($a ** 2);
echo "\n";

// --------------------------------------------
// 3.4 OPERADORES - RELACIONAIS E LÓGICOS
// --------------------------------------------

echo "Relacionais";
echo "\n";
echo "10 == 10: " . var_export($a == 10, true);
echo "\n";
echo "10 === '10': " . var_export($a === "10", true);
echo "\n";
echo "10 != 5: " . var_export($a != 5, true);
echo "\n";
echo "20 > 10: " . var_export($b > $a, true);
echo "\n";

// Operador lógico: && (E), || (OU), ! (NÃO)
echo "Lógicos";
echo "\n";
echo "&& (E): " . var_export($idade > 18 && $temCNH, true);
echo "\n";
echo "|| (OU): " . var_export($idade > 30 || $temCNH, true);
echo "\n";
echo "! (NÃO): " . var_export(!$temCNH, true);
echo "\n";

$maiorDeIdade = ($idade > 18 && $temCNH === true);
echo "Maior de idade com CNH: " . var_export($maiorDeIdade, true);
echo "\n";

// --------------------------------------------
// 3.5 ESTRUTURAS CONDICIONAIS
// --------------------------------------------

$nota = 7.5;

if ($nota >= 7) {
    echo "Aprovado com louvor!";
} elseif ($nota >= 5) {
    echo "Aprovado.";
} else {
    echo "Reprovado.";
}
echo "\n";

// Ternário: condição ? valor_verdadeiro : valor_falso
echo "Situação: " . ($nota >= 5 ? "Aprovado" : "Reprovado");
echo "\n";

// Match: alternativa moderna ao switch (PHP 8.0+)
$diaSemana = "sexta";

$status = match ($diaSemana) {
    "segunda", "terca", "quarta", "quinta" => "Início da semana.",
    "sexta" => "Sextou!",
    "sabado", "domingo" => "Fin de semana.",
    default => "Dia inválido.",
};

echo "Match: " . $status;
echo "\n";

// Operador null coalescing (??) - evita erro com variável não definida
$usuario = null;
$nomePadrao = $usuario ?? "Visitante";
echo "Nome padrão: " . $nomePadrao;