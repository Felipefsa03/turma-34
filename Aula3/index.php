<?php 

function limparTerminal(){
    echo "\033[2J\033[;H";
}

limparTerminal();
echo "       ------       \n";
echo "formulario xd       \n";
echo "       ------       \n";

// informações do usuario

$nome = readline("digite seu nome aqui: ");

while (true) {
    $email = readline("digite seu email: ");


    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        break; 
    }
    echo "email invalido! tente novamente. \n";
}

while (true) {
    $idade = readline("digite sua idade: ");

    if(filter_var($idade, FILTER_VALIDATE_INT)){
        break;
    }
    echo "isso não é sua idade sacana";
}

echo "\n selecione seu curso \n ";
echo "[1] curso de fazer 67 \n";
echo "[2] curso de larpar \n";
echo "[3] curso de farmar aura \n";

while (true){
    $opcao = readline("Escolha uma opção entre 1 a 3: ");

    switch ($opcao) {
        case '1': $perfil = "curso de fazer 67"; break 2;
        case '2': $perfil = "curso de larpar"; break 2;
        case '3': $perfil = "curso de farmar aura"; break 2;
        default: echo "X opção inválida! Escolha 1, 2 ou 3.\n";
    }
}

// aprovado

$minimo = 18;

$calculo1 = $idade >= $minimo ? "maior de idade" : "menor de idade";

$calculo2 = "menor de idade" == "aprovado" ? "aprovado" : "reprovado";

$calculo3 = "maior de idade" == "reprovado" ? "reprovado" : "aprovado";

$calculo4 = $idade >= $minimo ? "aprovado" : "reprovado";

// final

limparTerminal();

echo "       ------       \n";
echo "       parabens por ter concluido o formulario       \n";
echo "       ------       \n";

echo "👤 Nome: $nome \n";
echo "📧 E-mail: $email \n";
echo "🔑 curso: $perfil \n";
echo "🔍 o canditado está: $calculo4 \n";


?>