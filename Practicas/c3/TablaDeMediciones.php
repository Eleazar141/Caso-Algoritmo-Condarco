<?php

function busquedaLineal($lista, $numeroBuscado)
{
    foreach ($lista as $numero) {
        if ($numero === $numeroBuscado) {
            return true;
        }
    }

    return false;
}

$listas = [
    "Lista pequeña" => 25000,
    "Lista mediana" => 100000,
    "Lista grande" => 400000
];

$resultados = [];

foreach ($listas as $nombreLista => $cantidadNumeros) {

    $lista = range(1, $cantidadNumeros);

    $numeroBuscado = $cantidadNumeros;

    // Calentamiento
    busquedaLineal($lista, $numeroBuscado);

    $tiempos = [];
    $sumaTiempos = 0;

    for ($prueba = 1; $prueba <= 5; $prueba++) {

        $inicio = microtime(true);

        busquedaLineal($lista, $numeroBuscado);

        $fin = microtime(true);

        $tiempo = ($fin - $inicio) * 1000;

        $tiempos[] = $tiempo;

        $sumaTiempos += $tiempo;
    }

    $promedio = $sumaTiempos / 5;

    $resultados[] = [
        'nombre' => $nombreLista,
        'cantidad' => $cantidadNumeros,
        'pruebas' => $tiempos,
        'promedio' => $promedio
    ];
}

$comparacionMediana =
    $resultados[1]['promedio'] /
    $resultados[0]['promedio'];

$comparacionGrande =
    $resultados[2]['promedio'] /
    $resultados[0]['promedio'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Tabla de Mediciones</title>

<style>

body{
    font-family: Arial, sans-serif;
    margin:40px;
}

table{
    border-collapse: collapse;
    width:100%;
}

th, td{
    border:1px solid black;
    padding:10px;
    text-align:center;
}

th{
    background:#eeeeee;
}

</style>

</head>

<body>

<h1>Medición de Búsqueda Lineal</h1>

<p>
Se busca el último número de cada lista para medir el peor caso.
</p>

<table>

<tr>
    <th>Tipo de lista</th>
    <th>Cantidad de números</th>
    <th>Prueba 1</th>
    <th>Prueba 2</th>
    <th>Prueba 3</th>
    <th>Prueba 4</th>
    <th>Prueba 5</th>
    <th>Promedio (ms)</th>
</tr>

<?php foreach ($resultados as $fila): ?>

<tr>

<td><?= $fila['nombre'] ?></td>

<td><?= number_format($fila['cantidad']) ?></td>

<?php foreach ($fila['pruebas'] as $tiempo): ?>
<td><?= number_format($tiempo, 6) ?></td>
<?php endforeach; ?>

<td>
<strong>
<?= number_format($fila['promedio'], 6) ?>
</strong>
</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<h2>Comparaciones</h2>

<p>
Lista mediana comparada con lista pequeña:
<strong>
<?= number_format($comparacionMediana, 2) ?>
veces
</strong>
</p>

<p>
Lista grande comparada con lista pequeña:
<strong>
<?= number_format($comparacionGrande, 2) ?>
veces
</strong>
</p>

</body>
</html>