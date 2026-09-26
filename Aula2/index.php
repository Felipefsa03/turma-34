<?php
// o(1)
$Array = [
    "Fernanda",
    "Kleber",
    "Gabriel",
    "Kayo",
    "Luciano",
    "Luziane",
    "Robson",
    "Neto"
];

echo implode(", ", $Array);


// o(2^n)

echo "fernanda";
echo "kleber";
echo "gabriel";
echo "kayo";
echo "luciano";
echo "luziane";
echo "robson";
echo "neto";


// o(n!)
$fernanda = "fernanda";
$kleber = "kleber";
$gabriel = "gabriel";
$kayo = "kayo";
$luciano = "luciano";
$luziane = "luziane";
$robson = "robson";
$neto = "neto";

echo $fernanda;
echo $kleber;
echo $gabriel;
echo $kayo;
echo $luciano;  
echo $luziane;
echo $robson;
echo $neto;

?>

