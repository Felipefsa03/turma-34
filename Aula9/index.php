<?php

// $arrayIndexado = ['PHP', 'JavaScript', 'Python', 'Java', 'C#'];

// $arrayAssociativo = [
//     'linguagem1' => 'PHP',
//     'linguagem2' => 'JavaScript',
//     'linguagem3' => 'Python',
//     'linguagem4' => 'Java',
//     'linguagem5' => 'C#'
// ];

// var_dump($array);

// // echo $array[0]; // Output: PHP
// // echo $array[1]; // Output: JavaScript
// // echo $array[2]; // Output: Python
// // echo $array[3]; // Output: Java
// // echo $array[4]; // Output: C#

// $array[2] = '';
// var_dump($array);

// $array[] = 'Ruby';
// var_dump($array);

// (int) $texto = '2';

// (int) $neto = 1 + $texto;
// echo $neto;
// var_dump($neto, $texto);

function wagner (int $n1 /* primeiro paramentro */,
                 int $n2 /* segundo parametro */,
                string $clock /* terceiro parametro */
                ) {
    switch ($clock) {
        case 'somar':
            echo "A soma é: ".$n1 + $n2;
        break;

        case 'subtrair':
            echo "A subtrair é: ". $n1 - $n2;
        break;

        case 'multiplicar':
            echo "A multiplicar é: ". $n1 * $n2;
        break;

        case 'dividir':
            if ( $n2 !=0 ){
                echo "A dividez é: ". $n1 / $n2."\n"; ;
            }else{
                echo "Não é possivel fazer essa dividez \n"; 
            }  
        break;

        default:
            return "parametro clock errado";
        break;
}
}


echo "=============================\n";
echo "=           MENU            =\n";
echo "=============================\n";
(int)$v1 = readline("diga o primeiro valor: \n");
(int)$v2 = readline("diga o segundo valor: \n");

$option = readline("Qual operação matemática?\n");

$wagner = wagner(   
    $v1/* arg 1 */, 
    $v2/* arg 2 */,                              
    $option /* arg 3 */
    );


echo $wagner . "\n";
?>

