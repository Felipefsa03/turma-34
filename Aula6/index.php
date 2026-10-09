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

	