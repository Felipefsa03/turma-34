<?php

$peso1 = 0.40;
$peso2 = 0.60;

$nome = readline ("Qual o nome do aluno?");
$prova1 =  readline("Qual o valor da primeira nota?");
$prova2 =  readline("Qual o valor da segunda nota?");
$presenca = readline("Qual a porcentagem de presença?");
$notafinal = (($peso1 * $prova1) + ($peso2 * $prova2));


if ($notafinal < 0 || $notafinal > 10.00) {
    echo "A nota está errada. Insira a nota correta";
} elseif ($presenca <0 || $presenca > 100){
    echo "A presença está errada. Insira a presença correta";
}
elseif ($notafinal >= 7.00 && $presenca >= 70) {
    echo "Aprovado";
} elseif ($notafinal > 5.00 && $presenca >=70) {
    echo "Em recuperação";
} elseif ($presenca < 70){
    echo "Reprovado";
}
else {
    echo "Reprovado";
}







?>