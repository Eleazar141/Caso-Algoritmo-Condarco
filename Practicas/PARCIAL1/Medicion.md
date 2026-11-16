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

