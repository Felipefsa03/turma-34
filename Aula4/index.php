<?php

// ============================================
// AULA 04 - FUNDAMENTOS PHP (continuação)
// 3.3 Tipos e Conversões | 3.4 Interatividade | 3.5 Estruturas Condicionais
// ============================================

// --------------------------------------------
// 3.3 TIPOS DE DADOS
// --------------------------------------------
// Escalares : int, float, string, bool
// Compostos : array, object

var_dump(42);                    // int(42)
var_dump(7.5);                   // float(7.5)
var_dump("Maria");               // string(3) "Maria"
var_dump(true);                  // bool(true)
var_dump([1, 2, 3]);             // array(3)
var_dump(new stdClass());        // object(stdClass)#1
var_dump(null);                  // NULL

echo "\n";

// gettype() devolve o nome "legado" (integer/double)
// get_debug_type() devolve o nome canônico (int/float)
echo "gettype(42): " . gettype(42) . "\n";
echo "get_debug_type(42): " . get_debug_type(42) . "\n";
echo "gettype(7.5): " . gettype(7.5) . "\n";
echo "get_debug_type(7.5): " . get_debug_type(7.5) . "\n";

// Funções de verificação de tipo
var_dump(is_int(42), is_string("42"), is_float(7.5), is_bool(true), is_array([]));

echo "\n";


// --------------------------------------------
// 3.3 COERÇÃO AUTOMÁTICA (implícita)
// --------------------------------------------
// O PHP converte sozinho quando a operação faz sentido.

$numero_string = "10";
$soma = $numero_string + 5;  // "10" vira 10 -> 15

var_dump($numero_string);  // string(2) "10"  (a variável NÃO muda)
var_dump($soma);           // int(15)

echo "\n";

// String PARCIALMENTE numérica: o PHP lê o "10" e ignora o resto (Warning)
$misto = "10abc";
$resultadoMisto = $misto + 5;
var_dump($resultadoMisto); // int(15) + Warning: non-numeric value

echo "\n";

// String NÃO numérica em operação aritmética é um TypeError FATAL no PHP 8.
// Era apenas Warning + valor 0 no PHP 7. Por isso validamos antes de calcular.
// Testamos com is_numeric() para não interromper o script:
$texto = "abc";
var_dump(is_numeric($texto));            // false -> não pode entrar no cálculo
if (is_numeric($texto)) {
    var_dump($texto + 5);
} else {
    echo "Valor inválido para soma: \"$texto\"\n";
}


// --------------------------------------------
// 3.3 COERÇÃO FORÇADA (casting)
// --------------------------------------------
// O programador converte escrevendo o tipo entre parênteses.

$valor = (int) "100.5";     // 100  (perde os decimais)
var_dump($valor);

$valorFloat = (float) "100.5";  // 100.5
var_dump($valorFloat);

$valorInt = (int) 7.9;      // 7 (trunca, não arredonda)
var_dump($valorInt);

$paraTexto = (string) 123;  // "123"
var_dump($paraTexto);

$paraArray = (array) "abc"; // ["abc"]
var_dump($paraArray);

echo "\n";

// Todos os casts permitidos: (int) (bool) (float) (string) (array) (object) (unset)

echo "\n";


// --------------------------------------------
// VALORES "FALSY" - A ARMADILHA DO PHP
// --------------------------------------------
// Todos estes valores são considerados false em um if:

$falsy = [0, 0.0, "", "0", null, [], false];

foreach ($falsy as $valor) {
    echo "var_export(" . var_export($valor, true) . ") = " . var_export((bool) $valor, true) . "\n";
}

echo "\n";
// Atenção: "false" (string) e " " (espaço) são TRUE!
var_dump((bool) "false");  // bool(true)
var_dump((bool) "0abc");   // bool(true)
var_dump((bool) " ");      // bool(true)

echo "\n";


// --------------------------------------------
// A ARMADILHA DO ==
// --------------------------------------------
// == compara VALOR (com coerção)  -> cuidado
// === compara VALOR E TIPO        -> use sempre este

var_dump("10" == 10);    // true  (coeriu "10" para 10)
var_dump("10" === 10);   // false (tipos diferentes)
var_dump("abc" == 0);    // PHP 7: true | PHP 8: false
var_dump(null == false); // true
var_dump(null === false);// false

echo "\n";


// --------------------------------------------
// 3.4 INTERATIVIDADE - AMBIENTE WEB
// --------------------------------------------
// $_POST : dados enviados pelo corpo da requisição (form method="POST")
//          ideal para dados sensíveis ou longos (não aparece na URL)
// $_GET  : dados passados pela query string da URL (?chave=valor)
//          ideal para filtros, buscas e paginação

// isset() evita o Warning de "Undefined array key" quando o formulário ainda não foi enviado
if (isset($_POST['nome'])) {
    $nomeUsuario = trim($_POST['nome']);

    if ($nomeUsuario === "") {
        echo "Você não digitou nenhum nome!";
    } else {
        echo "Bem-vindo, $nomeUsuario!";
    }
}

echo "\n";

if (isset($_GET['idade'])) {
    // dado de URL sempre chega como string -> precisa de casting
    $idade = (int) $_GET['idade'];
    echo "Idade recebida pela URL: $idade";
}

echo "\n";


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 04 - Formulário</title>
</head>
<body>
    <form action="index.php" method="POST">
        <label for="nome">Digite seu nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Seu nome" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
<?php

// --------------------------------------------
// 3.4 INTERATIVIDADE - AMBIENTE CLI (Terminal)
// --------------------------------------------
// readline() só existe no terminal. Ao abrir pelo navegador, gera Fatal error,
// por isso verificamos o ambiente com PHP_SAPI antes de chamar.

echo "\n";

if (PHP_SAPI === 'cli' && function_exists('readline')) {
    echo "=== Testando readline() ===\n";

    $nomeCli = readline("Digite seu nome: ");
    $idadeCli = readline("Digite sua idade: ");

    // readline() sempre devolve string -> convertemos para int
    $idadeCli = (int) $idadeCli;

    echo "Olá, $nomeCli! Você tem $idadeCli anos.\n";
} else {
    echo "(Seção de readline() ignorada: este arquivo foi aberto pelo navegador)\n";
}

echo "\n";


// --------------------------------------------
// 3.5.1 CONDICIONAIS - if / elseif / else
// --------------------------------------------
// Tomada de decisão baseada em condições lógicas.
// if     -> executa se a condição for verdadeira
// elseif -> executa se a principal for falsa, mas esta for verdadeira
// else   -> executa quando todas falharam

$nota = 7;

if ($nota > 7) {
    echo "Aprovado com louvor!\n";
} elseif ($nota > 5) {
    echo "Recuperação!\n";
} else {
    echo "Reprovado!\n";
}

echo "\n";

// elseif com operadores lógicos combinando condições
$idade = 22;
$temCNH = true;

if ($idade >= 18 && $temCNH) {
    echo "Pode dirigir.\n";
} elseif ($idade >= 18) {
    echo "Maior de idade, mas ainda sem CNH.\n";
} else {
    echo "Menor de idade.\n";
}

echo "\n";

// Aninhamento de if
$logado = true;
$assinatura = false;

if ($logado) {
    if ($assinatura) {
        echo "Acesso total: conteúdo premium.\n";
    } else {
        echo "Acesso parcial: conteúdo gratuito.\n";
    }
} else {
    echo "Faça login para continuar.\n";
}

echo "\n";


// --------------------------------------------
// 3.5.2 CONDICIONAIS - switch
// --------------------------------------------
// Ideal para MENUS ou quando a variável tem opções FIXAS (igualdade).
// break é essencial: interrompe o fluxo para não executar os cases seguintes.

$dia = 2;

switch ($dia) {
    case 1:
        echo "Domingo\n";
        break;
    case 2:
        echo "Segunda-feira\n";
        break;
    case 3:
        echo "Terça-feira\n";
        break;
    default:
        echo "Dia inválido\n";
}

echo "\n";

// switch sem break: Os casos (fall-through), útil para agrupar
$mes = "dezembro";

switch ($mes) {
    case "janeiro":
    case "fevereiro":
    case "março":
        echo "Trimestre 1\n";
        break;
    case "abril":
    case "maio":
    case "junho":
        echo "Trimestre 2\n";
        break;
    default:
        echo "Outros meses\n";
}

echo "\n";


// --------------------------------------------
// ⚠️ switch NÃO serve para comparar FAIXAS
// --------------------------------------------
// case ($x >= 0 && $x <= 3) NÃO funciona como esperado: o switch compara
// $pessoa == true/false, ignorando toda a lógica interna do case.
// Para faixas de valores, use if / elseif.

echo "--- Comparação errada (switch) ---\n";
$pessoaErrado = 25;

switch ($pessoaErrado) {
    case ($pessoaErrado >= 0 && $pessoaErrado <= 3):
        echo "Bebê\n";
        break;
    case ($pessoaErrado >= 4 && $pessoaErrado <= 12):
        echo "Criança\n";
        break;
    default:
        echo "Idade inválida\n";
}

echo "\n";

echo "--- Versão correta (if / elseif) ---\n";
$pessoa = 25;

if ($pessoa < 0) {
    echo "Idade inválida!\n";
} elseif ($pessoa <= 3) {
    echo "De colo / Bebê\n";
} elseif ($pessoa <= 12) {
    echo "Criança\n";
} elseif ($pessoa <= 17) {
    echo "Adolescente\n";
} elseif ($pessoa <= 25) {
    echo "Adulto\n";
} elseif ($pessoa <= 59) {
    echo "Adulto pro max\n";
} elseif ($pessoa <= 70) {
    echo "Idoso Jr\n";
} elseif ($pessoa <= 80) {
    echo "Idoso Pleno\n";
} elseif ($pessoa <= 90) {
    echo "Idoso Sênior\n";
} elseif ($pessoa <= 100) {
    echo "Idoso Master\n";
} else {
    echo "Idade inválida!\n";
}

echo "\n";


// --------------------------------------------
// OPERADOR TERNÁRIO (3.5.3)
// --------------------------------------------
// Condicional em uma única linha. Equivale a um if/else simples.

$notaFinal = 8.5;
echo $notaFinal >= 7 ? "Aprovado\n" : "Reprovado\n";

// null coalescing: evita erro com variável não definida
$usuario = null;
echo "Nome: " . ($usuario ?? "Visitante") . "\n";