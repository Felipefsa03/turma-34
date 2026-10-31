<?php
// <!-- Requisitos mínimos:

// Catálogo de produtos em array multidimensional 
//     (nome, preço, categoria — os itens e preços são livres, parte da criatividade). ok

// Menu em loop (while/do-while) que deixa o cliente adicionar produtos até escolher "finalizar". ok

// Função para calcular o subtotal de um item (preço × quantidade)
//     e função para calcular o total do carrinho.

// Condicional aplicando desconto a partir de alguma regra sua 
//     (ex.: total acima de um valor, ou quantidade de itens).

// Carrinho guardado em array associativo/indexado durante a execução.

// String formatada para o recibo final (pode usar number_format).

// Tratar pelo menos uma entrada inválida (produto inexistente, quantidade ≤ 0) sem quebrar o programa. -->

$carrinho = [];

$products = [
   [
    "nome" => "bola",
    "preco"=> 50,
    "cetegoria"=> "futebol"
   ],
   [
    "nome" => "cheteira",
    "preco" => 100,
    "cetegoria" => "futebol"
   ],
   [
    "nome" => "luva",
    "preco" => 70,
    "cetegoria" => "futebol"
   ]
];


// O laço de repetição (do)
do {
    
    //Criação do menu
    echo "====================\n";
    echo "Menu"."\n";
    echo "====================\n";

    // escolhas do menu
    print_r("Produto 1: ".$products[0]['nome']."\n");
    print_r("Produto 2: ".$products[1]['nome']."\n");
    print_r("Produto 3: ".$products[2]['nome']."\n");
    echo "4: Finalizar\n\n";
     echo "====================\n";

    // 
    $option = [];
    $quantidade = [];

    
    $option = readline("Escolha uma opção: ");
    $quantidade = readline("Quantos? ");

    // Option 1 - $carrinho[0]
    // Option 2 - $carrinho[1]
    // $carrinho - (preco[] * quantidade[] + carrinho[])
    if ($option != 4) {
        switch ($option) {
        case ($option == "bola" || $option == 1) :
            print_r(
                "Você escolheu: " . $products[0]["nome"] . "\n" . 
                "cujo o preço é: " . $products[0]["preco"] . "\n".
                "E pediu: " . $quantidade . "unidades" . "\n" 
                );
        break;
            
        case ( $option == "cheteira" || $option == 2) :
            print_r(
                "Você escolheu: " . $products[1]["nome"] . "\n" . 
                "cujo o preço é: " . $products[1]["preco"] . "\n" .
                "E pediu: " . $quantidade . "unidades" . "\n"
                );
        break;
        case ( $option == "luva"|| $option == 3) :
            print_r(
                "Você escolheu: " . $products[2]["nome"] . "\n" . 
                "cujo o preço é: " . $products[2]["preco"] . "\n" .
                "E pediu: " . $quantidade . " unidades" . "\n"
                );
        break;
        case ( $option == ""|| $option == 4) :

        break;

        }
    } 





    var_dump( $option , $quantidade );
} while( $option != 4 );


// function caoculo ( $product ) { 
//     pegar o valor que o usuario selecionou
// }


?>