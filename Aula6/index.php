<?php


    // Desafio 1 — Meu primeiro cartão de apresentação
	// Crie um programa que exiba no terminal seu nome, idade, cidade e curso utilizando echo ou print.
	// Regras: cada informação deve aparecer em uma linha diferente. Exiba também um separador usando 
    // caracteres como ----------.


	// SAÍDA ESPERADA
	// ------ MEU PERFIL ------
	// Nome: João
	// Idade: 19
	// Cidade: Feira de Santana
	// Curso: Sistemas de Informação
	// ------------------------

    $nome = "Wagner";
    $idade = 25;
    $cidade = "Salvador";
    $curso = "Engenharia de Software";

    echo "------ MEU PERFIL ------\n";
    echo "Nome: " . $nome . "\n";
    echo "Idade: " . $idade . "\n";
    echo "Cidade: " . $cidade . "\n";
    echo "Curso: " . $curso . "\n";
    echo "------------------------\n";



    // 3.2 — Desafio 2: A lojinha virtual (Variáveis e constantes)
	// Uma loja quer exibir os dados de um produto. Crie variáveis para armazenar o nome, o preço e a 
    //  quantidade em estoque. Crie também uma constante NOME_LOJA.

	// Objetivo: exibir os dados do produto utilizando as variáveis e a constante, sem escrever 
    //  diretamente os valores na mensagem final.
	// Exemplo: Tech Store | Mouse Gamer | R$ 80 | Estoque: 5

    $name = "Mouse Gamer";
    $price = 80;
    $stock = 5;
    define("NOME_LOJA", "Tech Store");

    echo NOME_LOJA . " | " . $name . " | R$ " . $price . " | Estoque: " . $stock . "\n";



    // 3.2 — Desafio 3: Calculadora de compras (Operadores)
	// Utilizando as variáveis do desafio anterior, crie um programa que calcule o valor total de uma compra.
	// O programa deve:
	// - Multiplicar o preço pela quantidade comprada.
	// - Aplicar um desconto fixo de R$ 10.
	// - Verificar se o valor final é maior que R$ 100 usando um operador relacional.
	// EXEMPLO
	// Preço: R$ 80
	// Quantidade: 2
	// Subtotal: R$ 160
	// Desconto: R$ 10
	// Total: R$ 150
	// Compra acima de R$ 100? Sim

    $price = 80;
    $quantity = 2;
    $subtotal = $price * $quantity;
    $discount = 10;
    $total = $subtotal - $discount;

    echo "Preço: R$ " . $price . "\n";
    echo "Quantidade: " . $quantity . "\n";
    echo "Subtotal: R$ " . $subtotal . "\n";
    echo "Desconto: R$ " . $discount . "\n";
    echo "Total: R$ " . $total . "\n";

    if ($total > 100) {
        echo "Compra acima de R$ 100? Sim\n";
    } else {
        echo "Compra acima de R$ 100? Não\n";
    }




    // 3.3 — Desafio 4: O mistério dos tipos de dados
	// Crie quatro variáveis contendo: "25", 25, 25.5 e true.
	// Utilize var_dump() para descobrir o tipo de cada variável. Depois, transforme a string "25" em um 
    // número inteiro usando type casting e compare com o número 25 utilizando ===.
	// Pergunta para a turma: por que "25" === 25 retorna false, mesmo que os valores pareçam iguais?


    $a = "25";
    $b = 25;
    $c = 25.5;
    $d = true;

    var_dump($a);
    var_dump($b);
    var_dump($c);
    var_dump($d);

    $a = (int) $a;
    if ($a === $b) {
        echo "A variável 'a' é igual à variável 'b'\n";
    } else {
        echo "A variável 'a' não é igual à variável 'b'\n";
    }

    // 3.4 — Desafio 5: Cadastro interativo (Entrada de dados)
	// Desenvolva um pequeno cadastro que solicite ao usuário seu nome, sua idade e sua linguagem de 
    // programação favorita.
	// Utilize readline() e exiba uma mensagem personalizada ao final.
	// EXEMPLO DE EXECUÇÃO NO TERMINAL
	// Digite seu nome: Ana
	// Digite sua idade: 20
	// Linguagem favorita: PHP

	// Olá, Ana! Você tem 20 anos
	// e gosta de programar em PHP!


$name = readline("Digite seu nome: ");
$age = readline("Digite sua idade: ");
$favorite_language = readline("Linguagem favorita: ");

echo "\nOlá, " . $name . "! Você tem " . $age . " anos\n";
echo "e gosta de programar em " . $favorite_language . "!\n";



	// 3.5.1 — Desafio 6: Sistema de aprovação (if/else)
	// Uma escola precisa de um sistema para classificar as notas dos alunos.
	// Solicite uma nota entre 0 e 10 e exiba:
	// Nota	Resultado
	// 7 até 10	Aprovado
	// 5 até abaixo de 7	Recuperação
	// 0 até abaixo de 5	Reprovado
	// Fora de 0 a 10	Nota inválida
	// Desafio extra: solicite também a frequência do aluno. Para ser aprovado, ele precisa ter nota 
    // maior ou igual a 7 e frequência de pelo menos 75%.

    echo "\nSistema de aprovação\nDa escola de Wagner\n";
    $grade = readline("Digite a nota do aluno (0 a 10): ");
    $attendance = readline("Digite a frequência do aluno (em %): ");    
    if($grade >= 7 && $attendance >= 75){
        echo "Aprovado\n";
    }elseif($grade >= 5 && $grade < 7){
        echo "Recuperação\n";
    }elseif($grade >= 0 && $grade < 5){
        echo "Reprovado\n";
    }else{
        echo "Nota invalida";
    }



    // 3.5.2 — Desafio 7: Cardápio digital (switch)
	// Crie um programa que apresente o cardápio de uma lanchonete. O usuário deve digitar o número do 
    // produto desejado.
	// === LANCHONETE PHP ===
	// 1 - Hambúrguer: R$ 15
	// 2 - Pizza: R$ 25
	// 3 - Refrigerante: R$ 6
	// 4 - Suco: R$ 8

	// Escolha uma opção: 2

	// Você escolheu Pizza - R$ 25!

	// Utilize switch para identificar a escolha e default para tratar opções inválidas.

$precoHamburguer = 15;
$precoPizza = 25;
$precoRefrigerante = 6;
$precoSuco = 8;

echo "\n=== LANCHONETE PHP ===\n";
echo "1 - Hambúrguer: R$ " . $precoHamburguer . "\n";
echo "2 - Pizza: R$ " . $precoPizza . "\n";
echo "3 - Refrigerante: R$ " . $precoRefrigerante . "\n";
echo "4 - Suco: R$ " . $precoSuco . "\n";

$opcao = readline("Escolha uma opção: ");
echo "". $opcao . "";

echo "Voce escolheu ";
switch ($opcao) {
    case 1:
        echo "Hamburguer - R$ " . $precoHamburguer . "\n";
        break;
    case 2:
        echo "Pizza - R$ " . $precoPizza . "\n";
        break;
    case 3:
        echo "Refrigerante - R$ " . $precoRefrigerante . "\n";
        break;
    case 4:
        echo "Suco - R$ " . $precoSuco . "\n";
        break;
    default:
        echo "Opção inválida!\n";
        break;
}