<?php

function solucionIngenua($n)
{
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            // Simula buscar un postulante revisando toda la lista
        }
    }
}

function solucionAdecuada($n)
{
    for ($i = 0; $i < $n; $i++) {
        // Simula buscar postulantes organizados por categoria
    }
}

$tamanos = [8, 16, 32, 64];

echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>n</th>
        <th>Ingenua (ms)</th>
        <th>Adecuada (ms)</th>
      </tr>";

foreach ($tamanos as $n) {

    // Calentamiento
    solucionIngenua($n);
    solucionAdecuada($n);

    // Ingenua (3 pruebas)
    $inicio = microtime(true);
    solucionIngenua($n);
    $t1 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionIngenua($n);
    $t2 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionIngenua($n);
    $t3 = microtime(true) - $inicio;

    $promedioIngenua = (($t1 + $t2 + $t3) / 3) * 1000;


    $inicio = microtime(true);
    solucionAdecuada($n);
    $t1 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionAdecuada($n);
    $t2 = microtime(true) - $inicio;

    $inicio = microtime(true);
    solucionAdecuada($n);
    $t3 = microtime(true) - $inicio;

    $promedioAdecuada = (($t1 + $t2 + $t3) / 3) * 1000;

    echo "<tr>";
    echo "<td>$n</td>";
    echo "<td>" . number_format($promedioIngenua, 6) . "</td>";
    echo "<td>" . number_format($promedioAdecuada, 6) . "</td>";
    echo "</tr>";
}

echo "</table>";

?>
