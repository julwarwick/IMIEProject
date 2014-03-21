<?php

function chargerClasse($classe)
{
  require $classe . '.php'; 
}
spl_autoload_register('chargerClasse');


//$pdo = PDO2::getInstance();
//var_dump ($pdo);
$array = ["idLocationClass" => 1, "cityLocationClass" => "Angers"];
var_dump($array);
$classyear = new LocationClass($array);
var_dump($classyear);


