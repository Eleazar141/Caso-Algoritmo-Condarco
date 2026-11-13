<?php

session_start(); // Guarda los datos de la tabla aunque recargues la página
set_time_limit(0); // Evita que la página se detenga si el cálculo tarda mucho

// Insercion
function insercion(&$lista) {
    $total = count($lista);

    // Toma cada número uno por uno, empezando desde el segundo
    for ($i = 1; $i < $total; $i++) {
        $numeroActual = $lista[$i];
        $anterior = $i - 1;

        // Mientras el número de la izquierda sea más grande, lo mueve a la derecha
        while ($anterior >= 0 && $lista[$anterior] > $numeroActual) {
            $lista[$anterior + 1] = $lista[$anterior];
            $anterior--;
        }

        // Coloca el número en el lugar vacío que quedó
        $lista[$anterior + 1] = $numeroActual;
    }
}

// MÉTODO QUICKSORT
function quickSort(&$lista, $inicio, $fin) {
    // Si ya no hay nada que dividir, termina
    if ($inicio >= $fin) return;

    // Toma el número del medio como referencia
    $pivote = $lista[intdiv($inicio + $fin, 2)];
    $izq = $inicio;
    $der = $fin;

    // Separa los números menores a la izquierda y los mayores a la derecha
    while ($izq <= $der) {
        while ($lista[$izq] < $pivote) $izq++; // Busca un numero grande en la izquierda
        while ($lista[$der] > $pivote) $der--; // Busca un numerochico en la derecha

        // Si están del lado equivocado cambia de lugar
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
     <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .contenedor {
            background: #ffffff;
            width: 100%;
            max-width: 650px;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }
        h3 {
            font-size: 1.5rem;
            color: #0f172a;
            margin-bottom: 6px;
            text-align: center;
        }
        .subtitulo {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 24px;
        }
        .botones {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 16px;
        }
        button {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            background-color: #2563eb;
            color: white;
        }
        button:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        }
        button:active {
            transform: translateY(0);
        }
        .btn-limpiar {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .btn-limpiar:hover {
            background-color: #fecaca;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.15);
        }
        #aviso {
            text-align: center;
            color: #d97706;
            font-weight: 600;
            font-size: 0.95rem;
            min-height: 24px;
            margin-bottom: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        th {
            background-color: #0f172a;
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            padding: 14px;
        }
        td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        tr:hover td {
            background-color: #f1f5f9;
        }
        .dato-cantidad {
            font-weight: 700;
            color: #334155;
        }
        .dato-ins {
            color: #dc2626;
            font-weight: 600;
        }
        .dato-quick {
            color: #16a34a;
            font-weight: 600;
        }
    </style><body>

    <div class="contenedor">
        <h3>Inserción vs QuickSort</h3>
        <p class="subtitulo">Comparativa de rendimiento (Promedio de 3 corridas)</p>

        <!-- Botones para elegir cuántos números ordenar -->
        <form method="POST" class="botones" onsubmit="aviso.innerText='⏳ Calculando tiempos, por favor espera...'">
            <?php foreach ($cantidades as $c): ?>
                <button name="cantidad" value="<?= $c ?>">Probar <?= number_format($c) ?></button>
            <?php endforeach; ?>
            <button name="borrar" class="btn-limpiar">Limpiar</button>
        </form>

        <!-- Mensaje que aparece mientras carga -->
        <p id="aviso"></p>

        <!-- Tabla donde se muestran los tiempos -->
        <table>
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Inserción (O(n²))</th>
                    <th>QuickSort (O(n log n))</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cantidades as $c): ?>
                    <tr>
                        <td class="dato-cantidad"><?= number_format($c) ?></td>
                        <!-- Muestra el tiempo guardado o un guion '-' si aún no se prueba -->
                        <td class="dato-ins"><?= $_SESSION['tabla'][$c][0] ?? '-' ?></td>
                        <td class="dato-quick"><?= $_SESSION['tabla'][$c][1] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>