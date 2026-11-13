<?php

session_start(); // Guarda los datos de la tabla aunque recargues la página
set_time_limit(0); // Evita que la página se detenga si el cálculo tarda mucho

// 1. MÉTODO DE INSERCIÓN 
function insercion(&$lista) {
    // Recorre la lista desde el segundo número
    for ($i = 1; $i < count($lista); $i++) {
        $actual = $lista[$i]; // Número que vamos a acomodar
        
        // Mueve los números más grandes hacia la derecha
        for ($j = $i - 1; $j >= 0 && $lista[$j] > $actual; $j--) {
            $lista[$j + 1] = $lista[$j];
        }
        
        // Pone el número en el espacio libre que quedó
        $lista[$j + 1] = $actual;
    }
}

// 2. MÉTODO QUICKSORT
function quickSort(&$lista, $inicio, $fin) {
    // Si ya no hay nada que dividir, termina
    if ($inicio >= $fin) return;

    // Toma el número del medio como referencia (pivote)
    $pivote = $lista[intdiv($inicio + $fin, 2)];
    $izq = $inicio;
    $der = $fin;

    // Separa los números menores a la izquierda y los mayores a la derecha
    while ($izq <= $der) {
        while ($lista[$izq] < $pivote) $izq++; // Busca uno grande en la izquierda
        while ($lista[$der] > $pivote) $der--; // Busca uno chico en la derecha

        // Si están del lado equivocado, los cambia de lugar
        if ($izq <= $der) {
            [$lista[$izq], $lista[$der]] = [$lista[$der], $lista[$izq]];
            $izq++;
            $der--;
        }
    }

    // Repite lo mismo con la mitad izquierda y la mitad derecha
    if ($inicio < $der) quickSort($lista, $inicio, $der);
    if ($izq < $fin) quickSort($lista, $izq, $fin);
}

// Tamaños de las listas que vamos a probar
$cantidades = array(10000, 20000, 40000, 80000);

// Si presionas "Limpiar", borra los resultados de la tabla
if (isset($_POST['borrar'])) $_SESSION['tabla'] = [];

// Si presionas uno de los botones para probar
if (isset($_POST['cantidad'])) {
    $cantidad = (int)$_POST['cantidad'];

    // "Calienta" el programa con una lista chica antes de tomar el tiempo real
    $calentar = range(1, 500);
    shuffle($calentar);
    insercion($calentar);
    quickSort($calentar, 0, 499);

    $tIns = 0;   // Tiempo total de Inserción
    $tQuick = 0; // Tiempo total de QuickSort

    // Hace la prueba 3 veces para sacar un promedio
    for ($vuelta = 0; $vuelta < 3; $vuelta++) {
        // Crea una lista con números al azar
        $datos = [];
        for ($i = 0; $i < $cantidad; $i++) $datos[] = rand(1, 100000);

        // --- Prueba de Inserción ---
        $copia = $datos; // Hace una copia para no dañar la lista original
        $t = microtime(true); // Empieza el cronómetro
        insercion($copia);
        $tIns += (microtime(true) - $t) * 1000; // Guarda los milisegundos que tardó

        // Revisa que haya quedado bien ordenado
        if ($copia !== ($ok = $datos) && !sort($ok) || $copia !== $ok) die("Error");

        // --- Prueba de QuickSort ---
        $copia = $datos; // Usa exactamente la misma lista desordenada de antes
        $t = microtime(true); // Empieza el cronómetro
        quickSort($copia, 0, $cantidad - 1);
        $tQuick += (microtime(true) - $t) * 1000; // Guarda los milisegundos que tardó

        // Revisa que haya quedado bien ordenado
        if ($copia !== $ok) die("Error");
    }

    // Saca el promedio de las 3 pruebas y lo guarda para mostrarlo en la tabla
    $_SESSION['tabla'][$cantidad] = [
        round($tIns / 3, 2) . ' ms',
        round($tQuick / 3, 2) . ' ms'
    ];
}
?>

<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; margin: 30px;">
    <h3>Inserción vs QuickSort (3 corridas)</h3>

    <!-- Botones para elegir cuántos números ordenar -->
    <form method="POST" onsubmit="aviso.innerText='Calculando...'">
        <?php foreach ($cantidades as $c): ?>
            <button name="cantidad" value="<?= $c ?>">Probar <?= $c ?></button>
        <?php endforeach; ?>
        <button name="borrar">Limpiar</button>
    </form>

    <!-- Mensaje rojo que aparece mientras carga -->
    <p id="aviso" style="color: red;"></p>

    <!-- Tabla donde se muestran los tiempos -->
    <table border="1" cellpadding="8" cellspacing="0">
        <tr><th>Cantidad</th><th>Inserción</th><th>QuickSort</th></tr>
        <?php foreach ($cantidades as $c): ?>
            <tr>
                <td><?= $c ?></td>
                <!-- Muestra el tiempo guardado o un guion '-' si aún no se prueba -->
                <td><?= $_SESSION['tabla'][$c][0] ?? '-' ?></td>
                <td><?= $_SESSION['tabla'][$c][1] ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
