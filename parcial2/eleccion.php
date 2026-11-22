<?php
//Eleazar Rolando Condarco Beltran
class ReceptorMejorado
{
    private $lista = [];
    private $pendientes = [];
    private $orden = 0;

    public function Registrar($pedido, $plazoMinutos)
    {
        $this->lista[] = [
            'pedido' => $pedido,
            'plazo' => $plazoMinutos,
            'orden' => $this->orden++
        ];

        $this->pendientes[$pedido] = true;

        usort($this->lista, function ($a, $b) {

            if ($a['plazo'] == $b['plazo']) {
                return $a['orden'] <=> $b['orden'];
            }

            return $a['plazo'] <=> $b['plazo'];
        });
    }

    public function PrepararSiguiente()
    {
        if (empty($this->lista)) {
            return null;
        }

        $pedido = array_shift($this->lista);

        unset($this->pendientes[$pedido['pedido']]);

        return $pedido['pedido'];
    }

    public function EstaPendiente($pedido)
    {
        return isset($this->pendientes[$pedido]);
    }

    public function Pendientes()
    {
        return count($this->pendientes);
    }
}


$pasteleria = new ReceptorMejorado();

$pasteleria->Registrar("Torta", 30);
$pasteleria->Registrar("Queque", 10);
$pasteleria->Registrar("Galletas", 20);
$pasteleria->Registrar("Pie", 10);

echo "Pendientes: " . $pasteleria->Pendientes() . "<br>";

echo "¿Queque pendiente? ";
echo $pasteleria->EstaPendiente("Queque") ? "Si" : "No";
echo "<br><br>";

echo "Preparando: " . $pasteleria->PrepararSiguiente() . "<br>";
echo "Preparando: " . $pasteleria->PrepararSiguiente() . "<br>";
echo "Preparando: " . $pasteleria->PrepararSiguiente() . "<br>";
echo "Preparando: " . $pasteleria->PrepararSiguiente() . "<br><br>";

echo "Pendientes: " . $pasteleria->Pendientes();

?>
