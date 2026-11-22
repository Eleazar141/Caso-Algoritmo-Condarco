<?php

function solucionIngenua($n)
{
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
        }
    }
}

function solucionAdecuada($n)
{
    for ($i = 0; $i < $n; $i++) {
    }
}

$tamanos = [50, 60, 70];

echo "<h2>Resultados</h2>";

foreach ($tamanos as $n) {

    solucionIngenua($n);
    solucionAdecuada($n);

    $inicio = microtime(true);
    solucionIngenua($n);
    $tiempo1 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionIngenua($n);
    $tiempo2 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionIngenua($n);
    $tiempo3 = microtime(true) - $inicio;

    $promedioIngenua = ($tiempo1 + $tiempo2 + $tiempo3) / 3;

    $inicio = microtime(true);
    solucionAdecuada($n);
    $tiempo1 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionAdecuada($n);
    $tiempo2 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionAdecuada($n);
    $tiempo3 = microtime(true) - $inicio;

    $promedioAdecuada = ($tiempo1 + $tiempo2 + $tiempo3) / 3;

    echo "Postulantes: $n <br>";
    echo "Promedio Solución Ingenua: " . number_format($promedioIngenua, 8) . " segundos<br>";
    echo "Promedio Solución Adecuada: " . number_format($promedioAdecuada, 8) . " segundos<br><br>";
}
?>
