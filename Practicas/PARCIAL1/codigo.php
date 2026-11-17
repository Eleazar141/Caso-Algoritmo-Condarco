//Eleazar Rolando Condarco Beltran

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
