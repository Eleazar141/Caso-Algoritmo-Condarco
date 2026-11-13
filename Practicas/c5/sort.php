<?php

session_start();
set_time_limit(0);

function ordenarPorInsercion(&$numeros) {
    $totalElementos = count($numeros);
    for ($indiceActual = 1; $indiceActual < $totalElementos; $indiceActual++) {
        $valorActual = $numeros[$indiceActual];
        
        for ($indiceAnterior = $indiceActual - 1; $indiceAnterior >= 0 && $numeros[$indiceAnterior] > $valorActual; $indiceAnterior--) {
            $numeros[$indiceAnterior + 1] = $numeros[$indiceAnterior];
        }
        
        $numeros[$indiceAnterior + 1] = $valorActual;
    }
}

function ordenarPorQuickSort(&$numeros, $indiceInicio, $indiceFin) {
    if ($indiceInicio >= $indiceFin) return;

    $valorPivote = $numeros[intdiv($indiceInicio + $indiceFin, 2)];
    $punteroIzquierdo = $indiceInicio;
    $punteroDerecho = $indiceFin;

    while ($punteroIzquierdo <= $punteroDerecho) {
        while ($numeros[$punteroIzquierdo] < $valorPivote) $punteroIzquierdo++;
        while ($numeros[$punteroDerecho] > $valorPivote) $punteroDerecho--;

        if ($punteroIzquierdo <= $punteroDerecho) {
            [$numeros[$punteroIzquierdo], $numeros[$punteroDerecho]] = [$numeros[$punteroDerecho], $numeros[$punteroIzquierdo]];
            $punteroIzquierdo++;
            $punteroDerecho--;
        }
    }

    if ($indiceInicio < $punteroDerecho) ordenarPorQuickSort($numeros, $indiceInicio, $punteroDerecho);
    if ($punteroIzquierdo < $indiceFin) ordenarPorQuickSort($numeros, $punteroIzquierdo, $indiceFin);
}

$tamanosDePrueba =;

if (isset($_POST['limpiarTabla'])) {
    $_SESSION['resultadosTabla'] = [];
}

if (isset($_POST['cantidadElementos'])) {
    $cantidadElementos = (int)$_POST['cantidadElementos'];

    $listaCalentamiento = range(1, 500);
    shuffle($listaCalentamiento);
    ordenarPorInsercion($listaCalentamiento);
    ordenarPorQuickSort($listaCalentamiento, 0, 499);

    $tiempoTotalInsercion = 0;
    $tiempoTotalQuickSort = 0;
    $numeroDeRepeticiones = 3;

    for ($repeticion = 0; $repeticion < $numeroDeRepeticiones; $repeticion++) {
        $numerosAleatorios = [];
        for ($i = 0; $i < $cantidadElementos; $i++) {
            $numerosAleatorios[] = rand(1, 100000);
        }

        $listaParaOrdenar = $numerosAleatorios;
        $tiempoInicio = microtime(true);
        ordenarPorInsercion($listaParaOrdenar);
        $tiempoTotalInsercion += (microtime(true) - $tiempoInicio) * 1000;

        $listaVerificada = $numerosAleatorios;
        sort($listaVerificada);
        if ($listaParaOrdenar !== $listaVerificada) die("Error en Inserción");

        $listaParaOrdenar = $numerosAleatorios;
        $tiempoInicio = microtime(true);
        ordenarPorQuickSort($listaParaOrdenar, 0, $cantidadElementos - 1);
        $tiempoTotalQuickSort += (microtime(true) - $tiempoInicio) * 1000;

        if ($listaParaOrdenar !== $listaVerificada) die("Error en QuickSort");
    }

    $_SESSION['resultadosTabla'][$cantidadElementos] = [
        number_format($tiempoTotalInsercion / $numeroDeRepeticiones, 2) . ' ms',
        number_format($tiempoTotalQuickSort / $numeroDeRepeticiones, 2) . ' ms'
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparativa: Inserción vs QuickSort</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
        button { padding: 8px 14px; margin-right: 6px; cursor: pointer; border: 1px solid #ccc; border-radius: 4px; background: #f4f4f4; }
        button:hover { background: #e2e2e2; }
        .btn-limpiar { background: #ffecec; border-color: #f5c2c2; color: #a33; }
        table { border-collapse: collapse; margin-top: 15px; width: 420px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f0f0f0; }
        #mensajeEstado { color: #d9534f; font-weight: bold; min-height: 20px; }
    </style>
</head>
<body>
    <h2>Comparativa de Ordenamiento (Promedio de 3 corridas)</h2>

    <form method="POST" onsubmit="mensajeEstado.innerText='Calculando tiempos, por favor espera...'">
        <?php foreach ($tamanosDePrueba as $tamano): ?>
            <button name="cantidadElementos" value="<?= $tamano ?>">Probar <?= number_format($tamano) ?></button>
        <?php endforeach; ?>
        <button name="limpiarTabla" class="btn-limpiar">Limpiar tabla</button>
    </form>

    <p id="mensajeEstado"></p>

    <table>
        <tr>
            <th>Cantidad de datos</th>
            <th>Inserción</th>
            <th>QuickSort</th>
        </tr>
        <?php foreach ($tamanosDePrueba as $tamano): ?>
            <tr>
                <td><?= number_format($tamano) ?></td>
                <td><?= $_SESSION['resultadosTabla'][$tamano] ?? '-' ?></td>
                <td><?= $_SESSION['resultadosTabla'][$tamano] ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
