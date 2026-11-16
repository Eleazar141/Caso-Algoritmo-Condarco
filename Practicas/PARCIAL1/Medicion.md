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
