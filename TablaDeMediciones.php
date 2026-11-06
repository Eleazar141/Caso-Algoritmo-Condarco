<?php

function busquedaLineal($lista, $objetivo)
{
    foreach ($lista as $numero) {
        if ($numero === $objetivo) {
            return true;
        }
    }

    return false;
}

// Lista de 100.000 números
$n = 100000;

// Número a buscar (último elemento = peor caso)
$objetivo = $n;

// Crear lista
$lista = range(1, $n);

$corridas = 15;

$tiempos = [];
$sumaTiempo = 0;

for ($i = 1; $i <= $corridas; $i++) {

    $inicio = microtime(true);

    busquedaLineal($lista, $objetivo);

    $fin = microtime(true);

    $tiempoMs = ($fin - $inicio) * 1000;

    $tiempos[] = $tiempoMs;

    $sumaTiempo += $tiempoMs;
}

$promedio = $sumaTiempo / $corridas;

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Medición de Búsqueda Lineal</title>

<style>
body{
    font-family: Arial, sans-serif;
    margin:40px;
}

table{
    border-collapse: collapse;
    width:500px;
}

th, td{
    border:1px solid black;
    padding:10px;
    text-align:center;
}

th{
    background:#f0f0f0;
}

.promedio{
    background:#dff0d8;
    font-weight:bold;
}
</style>

</head>
<body>

<h1>Búsqueda Lineal - 100.000 elementos</h1>

<p>
Número buscado: <strong><?php echo $objetivo; ?></strong>
</p>

<table>

<tr>
    <th>Corrida</th>
    <th>Tiempo (ms)</th>
</tr>

<?php foreach($tiempos as $indice => $tiempo): ?>

<tr>
    <td><?php echo $indice + 1; ?></td>
    <td><?php echo number_format($tiempo, 6); ?></td>
</tr>

<?php endforeach; ?>

<tr class="promedio">
    <td>Promedio</td>
    <td><?php echo number_format($promedio, 6); ?></td>
</tr>

</table>

</body>
</html>