<?php

// ============================================
// DESAFIO DAS AULAS 03 E 04
// Sistema de Gestão de Notas
// ============================================
// SOLUÇÃO DE REFERÊNCIA
//
// Tente resolver sozinho antes de abrir este arquivo.
// Regra de ouro: leia o código, apague e reescreva do zero.
//
// Conceitos: saída de dados, variáveis, constantes, tipos,
// coerção/casting, entrada via readline(), if/elseif/else,
// switch, ternário e null coalescing.
// ============================================

if (PHP_SAPI !== 'cli') {
    exit("Este desafio deve ser executado no terminal: php desafio.php\n");
}

if (!function_exists('readline')) {
    exit("A extensão readline do PHP não está habilitada.\n");
}

// --------------------------------------------
// CONSTANTES
// --------------------------------------------
// Pesos das notas na média ponderada (soma = 10)
const PESO_NOTA1 = 4.0;
const PESO_NOTA2 = 6.0;
const NOTA_MINIMA = 0.0;
const NOTA_MAXIMA = 10.0;
const MEDIA_APROVACAO = 7.0;
const MEDIA_RECUPERACAO = 5.0;
const IDADE_MINIMA = 16;

define("TITULO", "Sistema de Gestão de Notas");

// --------------------------------------------
// ESTRUTURAS DE DADOS (array)
// --------------------------------------------
$alunos = [];
$notas = [];

echo "\n";
echo "============================================\n";
echo "  " . TITULO . "\n";
echo "============================================\n";

// --------------------------------------------
// FUNÇÃO AUXILIAR (3.8 - spoiler da próxima aula)
// --------------------------------------------
function classificar($media)
{
    if ($media >= MEDIA_APROVACAO) {
        return "Aprovado";
    } elseif ($media >= MEDIA_RECUPERACAO) {
        return "Recuperacao";
    }

    return "Reprovado";
}

function mediaPonderada($nota1, $nota2)
{
    return ($nota1 * PESO_NOTA1 + $nota2 * PESO_NOTA2) / (PESO_NOTA1 + PESO_NOTA2);
}

function cor($texto, $codigo)
{
    return "\033[$codigo;1m{$texto}\033[0m";
}

// --------------------------------------------
// LOOP PRINCIPAL (3.6 - spoiler da próxima aula)
// --------------------------------------------
while (true) {

    // 3.4 INTERATIVIDADE: opcao lida via readline
    echo "\n";
    echo "--- MENU ---\n";
    echo "1. Cadastrar aluno\n";
    echo "2. Registrar notas\n";
    echo "3. Ver relatorio\n";
    echo "4. Sair\n";

    // readline() devolve false quando o STDIN acaba (EOF).
    // Guardamos o valor cru ANTES do trim, porque trim(false) devolveria ""
    // e a comparação com false nunca seria verdadeira.
    $entrada = readline("Escolha uma opcao: ");

    if ($entrada === false) {
        echo "\n\nEncerrando (fim da entrada).\n";
        exit(0);
    }

    $opcao = trim($entrada);

    // 3.5.2 CONDICIONAL: switch para menu com valores fixos
    switch ($opcao) {
        case "1":
            // ---- CADASTRAR ALUNO ----
            echo "\n-- CADASTRAR ALUNO --\n";

            $nome = trim(readline("Nome: "));
            // readline() devolve string -> coerção forçada para int
            $idade = (int) readline("Idade: ");

            // 3.5.1 CONDICIONAL: if/elseif para validar faixa
            if ($nome === "") {
                echo cor("Nome invalido.\n", 31);
                break;
            } elseif ($idade < IDADE_MINIMA) {
                echo cor("Idade invalida para o sistema (minimo " . IDADE_MINIMA . " anos).\n", 31);
                break;
            } elseif ($idade > 120) {
                echo cor("Idade invalida para o sistema.\n", 31);
                break;
            }

            $alunos[] = ["nome" => $nome, "idade" => $idade];
            $indice = count($alunos) - 1;

            echo cor("Aluno [$indice] $nome cadastrado.\n", 32);
            break;

        case "2":
            // ---- REGISTRAR NOTAS ----
            echo "\n-- REGISTRAR NOTAS --\n";

            if (empty($alunos)) {
                echo cor("Nenhum aluno cadastrado.\n", 31);
                break;
            }

            foreach ($alunos as $i => $aluno) {
                echo "\nAluno [$i]: {$aluno['nome']}\n";

                // is_numeric() evita TypeError fatal do PHP 8
                $n1 = readline("  Nota 1 (0-" . NOTA_MAXIMA . "): ");
                $n2 = readline("  Nota 2 (0-" . NOTA_MAXIMA . "): ");

                if (!is_numeric($n1) || !is_numeric($n2)) {
                    echo cor("  Nota invalida: use apenas numeros.\n", 31);
                    continue;
                }

                // coerção forçada para float
                $n1 = (float) $n1;
                $n2 = (float) $n2;

                // validação de faixa com operadores relacionais e lógicos
                if ($n1 < NOTA_MINIMA || $n1 > NOTA_MAXIMA
                    || $n2 < NOTA_MINIMA || $n2 > NOTA_MAXIMA) {
                    echo cor("  Nota fora do intervalo " . NOTA_MINIMA . "-" . NOTA_MAXIMA . ".\n", 31);
                    continue;
                }

                $notas[$i] = [
                    "nota1" => $n1,
                    "nota2" => $n2,
                    "media" => mediaPonderada($n1, $n2),
                ];

                $media = $notas[$i]["media"];
                echo cor(sprintf("  Media: %.2f - %s\n", $media, classificar($media)), 36);
            }
            break;

        case "3":
            // ---- RELATORIO ----
            echo "\n-- RELATORIO --\n";

            if (empty($alunos)) {
                echo cor("Nenhum aluno cadastrado.\n", 31);
                break;
            }

            $soma = 0.0;
            $contagem = 0;
            $aprovados = 0;
            $recuperacao = 0;
            $reprovados = 0;

            foreach ($alunos as $i => $aluno) {
                $nome = $aluno["nome"];

                // null coalescing evita warning se o aluno ainda nao tem nota
                $nota = $notas[$i] ?? null;

                if ($nota === null) {
                    echo sprintf("  [%d] %-20s sem nota\n", $i, $nome);
                    continue;
                }

                $media = $nota["media"];
                $situacao = classificar($media);

                // 3.5.3 OPERADOR TERNÁRIO para escolher a cor
                $cor = $situacao === "Aprovado" ? 32 : ($situacao === "Recuperacao" ? 33 : 31);

                echo sprintf(
                    "  [%d] %-20s N1: %04.2f  N2: %04.2f  Media: %04.2f  %s\n",
                    $i,
                    $nome,
                    $nota["nota1"],
                    $nota["nota2"],
                    $media,
                    cor($situacao, $cor)
                );

                $soma += $media;
                $contagem++;

                if ($situacao === "Aprovado") {
                    $aprovados++;
                } elseif ($situacao === "Recuperacao") {
                    $recuperacao++;
                } else {
                    $reprovados++;
                }
            }

            if ($contagem > 0) {
                echo "\n";
                echo "  Media geral da turma: " . cor(sprintf("%.2f", $soma / $contagem), 36) . "\n";
                echo "  Aprovados: $aprovados | Recuperacao: $recuperacao | Reprovados: $reprovados\n";
            } else {
                echo cor("\n  Nenhuma nota registrada.\n", 31);
            }

            // dump completo das estruturas - otimo para debug
            echo "\n  Estrutura dos arrays:\n";
            print_r($alunos);
            break;

        case "4":
            echo "\nAte logo!\n\n";
            exit(0);

        default:
            echo cor("\nOpcao invalida. Escolha 1, 2, 3 ou 4.\n", 31);
    }
}