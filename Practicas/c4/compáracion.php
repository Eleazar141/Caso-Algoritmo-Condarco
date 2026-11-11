
<?php

// Crea un arreglo ordenado del 1 al 1.000.000
$numeros = range(1, 1000000);

// Genera 1000 números que sí existen en el arreglo
$claves = [];
for ($i = 0; $i < 1000; $i++) {
    $claves[] = rand(1, 1000000);
}

// Busca recorriendo elemento por elemento
function busquedaLineal($arr, $valor) {
    foreach ($arr as $num) {
        if ($num == $valor) {
            return true;
        }
    }
    return false;
}

// Busca dividiendo el arreglo por la mitad
function busquedaBinaria($arr, $valor) {
    $inicio = 0;
    $fin = count($arr) - 1;

    while ($inicio <= $fin) {
        $medio = intdiv($inicio + $fin, 2);

        if ($arr[$medio] == $valor) {
            return true;
        }

        if ($arr[$medio] < $valor) {
            $inicio = $medio + 1;
        } else {
            $fin = $medio - 1;
        }
    }

    return false;
}

// Mide tiempo de búsqueda lineal
$inicio = microtime(true);

foreach ($claves as $clave) {
    busquedaLineal($numeros, $clave);
}

$tiempoLineal = microtime(true) - $inicio;

// Mide tiempo de búsqueda binaria
$inicio = microtime(true);

foreach ($claves as $clave) {
    busquedaBinaria($numeros, $clave);
}

$tiempoBinaria = microtime(true) - $inicio;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comparación de Búsquedas</title>
</head>
<body>

<h1>Lineal vs Binaria</h1>

<p><b>Tiempo búsqueda lineal:</b> <?php echo $tiempoLineal; ?> segundos</p>

<p><b>Tiempo búsqueda binaria:</b> <?php echo $tiempoBinaria; ?> segundos</p>

</body>
</html>
