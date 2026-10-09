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
