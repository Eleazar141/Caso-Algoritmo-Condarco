<?php

class PlanificadorMejorado
{
    private $enViaje = [];

    public function Elegir($paquetes, $capacidad)
    {
        $this->enViaje = [];

        $n = count($paquetes);

        if ($n == 0 || $capacidad <= 0) {
            return [
                "ganancia" => 0,
                "codigos" => []
            ];
        }

        $dp = array_fill(0, $n + 1, array_fill(0, $capacidad + 1, 0));

        for ($i = 1; $i <= $n; $i++) {
            $peso = $paquetes[$i - 1]["peso"];
            $ganancia = $paquetes[$i - 1]["ganancia"];

            for ($c = 0; $c <= $capacidad; $c++) {

                if ($peso <= $c) {
                    $tomar = $ganancia + $dp[$i - 1][$c - $peso];
                    $dejar = $dp[$i - 1][$c];

                    $dp[$i][$c] = max($tomar, $dejar);
                } else {
                    $dp[$i][$c] = $dp[$i - 1][$c];
                }
            }
        }

        $codigos = [];
        $c = $capacidad;

        for ($i = $n; $i > 0; $i--) {

            if ($dp[$i][$c] != $dp[$i - 1][$c]) {

                $codigo = $paquetes[$i - 1]["codigo"];
                $codigos[] = $codigo;

                $this->enViaje[$codigo] = true;

                $c -= $paquetes[$i - 1]["peso"];
            }
        }

        return [
            "ganancia" => $dp[$n][$capacidad],
            "codigos" => $codigos
        ];
    }

    public function EstaEnElViaje($codigo)
    {
        return isset($this->enViaje[$codigo]);
    }
}


$paquetes = [
    ["codigo" => "A", "peso" => 6, "ganancia" => 60],
    ["codigo" => "B", "peso" => 4, "ganancia" => 50],
    ["codigo" => "C", "peso" => 10, "ganancia" => 101]
];

$planificador = new PlanificadorMejorado();

$resultado = $planificador->Elegir($paquetes, 10);

echo "Ganancia: " . $resultado["ganancia"] . PHP_EOL;

echo "Paquetes elegidos: ";
echo implode(", ", $resultado["codigos"]) . PHP_EOL;

echo "A esta en el viaje: ";
echo $planificador->EstaEnElViaje("A") ? "SI" : "NO";
echo PHP_EOL;

echo "C esta en el viaje: ";
echo $planificador->EstaEnElViaje("C") ? "SI" : "NO";
echo PHP_EOL;
