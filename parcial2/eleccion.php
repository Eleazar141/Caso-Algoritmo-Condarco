<?php

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

?>
