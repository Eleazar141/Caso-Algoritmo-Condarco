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
        round($tiempoTotalInsercion / $numeroDeRepeticiones, 2) . ' ms',
        round($tiempoTotalQuickSort / $numeroDeRepeticiones, 2) . ' ms'
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<body style="font-family: sans-serif; margin: 30px;">
    <h3>Inserción vs QuickSort (3 corridas)</h3>

    <form method="POST" onsubmit="mensajeEstado.innerText='Calculando...'">
        <?php foreach ($tamanosDePrueba as $tamano): ?>
            <button name="cantidadElementos" value="<?= $tamano ?>">Probar <?= $tamano ?></button>
        <?php endforeach; ?>
        <button name="limpiarTabla">Limpiar</button>
    </form>

    <p id="mensajeEstado" style="color: red;"></p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Cantidad</th>
            <th>Inserción</th>
            <th>QuickSort</th>
        </tr>
        <?php foreach ($tamanosDePrueba as $tamano): ?>
            <tr>
                <td><?= $tamano ?></td>
                <td><?= $_SESSION['resultadosTabla'][$tamano][0] ?? '-' ?></td>
                <td><?= $_SESSION['resultadosTabla'][$tamano][1] ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
