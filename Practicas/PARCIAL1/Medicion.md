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

