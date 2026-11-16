Eleazar Rolando Condarco Beltran
1.

Mi cura recorre la lista una sola vez guardando los carnets vistos en un arreglo auxiliar con un costo de O(n).


function HayRepetidosCurado($carnets)
{
    $vistos = [];

    foreach ($carnets as $carnet) {
        if (isset($vistos[$carnet])) {
            return true;
        }

        $vistos[$carnet] = true;
    }
    
    return false;

}
2.

Mi cura guarda los carnets ya vistos en un arreglo auxiliar y detecta repetidos en una sola pasada. Su costo es O(n).

n	PorPares(ms)	Curado(ms)
5000	607.41		0.89
10000	2330.44		1.54
20000	7838.07		2.18
40000	37164.78		12.64

El método Por Pares tarda más cuando aumenta la cantidad de carnets.
El método Curado es más rápido porque revisa los datos en una sola pasada.
En algunas pruebas hubo pequeñas variaciones en los tiempos.
La prueba con 40.000 registros fue la que más tiempo tardó.




Codigo completo:

<?php

function HayRepetidosPorPares($carnets)
{
    $n = count($carnets);

    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ($carnets[$i] == $carnets[$j]) {
                return true;
            }
        }
    }

    return false;
}

function HayRepetidosCurado($carnets)
{
    $vistos = [];

    foreach ($carnets as $carnet) {
        if (isset($vistos[$carnet])) {
            return true;
        }

        $vistos[$carnet] = true;
    }

    return false;
}

function GenerarSinRepetidos($n)
{
    $datos = range(0, $n - 1);
    shuffle($datos);
    return $datos;
}

$tamanos = [5000, 10000, 20000, 40000];

echo "<pre>";
echo "n\tPorPares(ms)\tCurado(ms)\n";

foreach ($tamanos as $n) {

    $datos = GenerarSinRepetidos($n);

    $inicio = microtime(true);
    HayRepetidosPorPares($datos);
    $lento = (microtime(true) - $inicio) * 1000;

    $inicio = microtime(true);
    HayRepetidosCurado($datos);
    $curado = (microtime(true) - $inicio) * 1000;

    echo $n . "\t" . round($lento, 2) . "\t\t" . round($curado, 2) . "\n";
}
echo "</pre>";

?>
