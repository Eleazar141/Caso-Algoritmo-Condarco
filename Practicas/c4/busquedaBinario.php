<?php

// Datos ordenados para la búsqueda
$datos = [3, 8, 12, 19, 25, 31, 40, 47];

// Guarda los pasos realizados
$pasos31 = [];
$pasos5 = [];

function busquedaBinaria($datos, $buscar, &$pasos)
{
    $inicio = 0;
    $fin = count($datos) - 1;

    while ($inicio <= $fin) {

        // Obtiene la posición central
        $medio = intdiv($inicio + $fin, 2);

        // Guarda el valor revisado
        $pasos[] = $datos[$medio];

        if ($datos[$medio] == $buscar) {
            return true;
        }

        if ($buscar > $datos[$medio]) {
            $inicio = $medio + 1;
        } else {
            $fin = $medio - 1;
        }
    }

    return false;
}

// Busca el 31
$encontrado31 = busquedaBinaria($datos, 31, $pasos31);

// Busca el 5
$encontrado5 = busquedaBinaria($datos, 5, $pasos5);

// Calcula pasos máximos aproximados
$pasos1000 = ceil(log(1000, 2));
$pasos1000000 = ceil(log(1000000, 2));

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Búsqueda Binaria</title>
</head>
<body>

<h1>Práctica: Búsqueda Binaria</h1>

<h2>Datos</h2>
<p>[3, 8, 12, 19, 25, 31, 40, 47]</p>
<p>
<h2>Buscar 31</h2>
<p>Medios revisados: <?php echo implode(' → ', $pasos31); ?></p>
<p>Pasos: <?php echo count($pasos31); ?></p>

<h2>Buscar 5</h2>
<p>Medios revisados: <?php echo implode(' → ', $pasos5); ?></p>
<p>Pasos: <?php echo count($pasos5); ?></p>

<h2>Máximo de pasos</h2>
<p>Para 1.000 datos: <?php echo $pasos1000; ?> pasos</p>
<p>Para 1.000.000 datos: <?php echo $pasos1000000; ?> pasos</p>

</body>
</html>
