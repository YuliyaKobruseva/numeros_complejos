<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Complejo
 *
 * @author Yuli
 */
class Complejo {

    //put your code here
    private $real;
    private $imaginario;

    function __construct(float $real, float $imaginario) {
        $this->real = $real;
        $this->imaginario = $imaginario;
    }

    function __get($name) {
        if ($name == "absoluto") {
            return sqrt(pow($this->real, 2) + pow($this->imaginario, 2));
        } else if ($name == "argumento") {
            //devuelve valor en grados
            return rad2deg(atan($this->imaginario / $this->real));
        }
        if (property_exists('Complejo', $name)) {
            return $this->$name;
        } else {
            throw new Exception('Propiedad desconocida');
        }
    }

    function __set($name, $value) {
        if ($name == "real" || $name == "imaginario") {
            $this->real = $value;
        } else if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception('Propiedad desconocida');
        }
    }

    function sumar(Complejo $complejo) {
        $this->real += $complejo->real;
        $this->imaginario += $complejo->imaginario;
    }

    function restar(Complejo $complejo) {
        $this->real = $this->real - $complejo->real;
        $this->imaginario = $this->imaginario - $complejo->imaginario;
    }

    function igual(Complejo $complejo): bool {
        return $this->real == $complejo->real && $this->imaginario == $complejo->imaginario;
    }

    function multiplicar(Complejo $complejo) {
        $r = $this->real * $complejo->real - $this->imaginario * $complejo->imaginario;
        $i = $this->real * $complejo->imaginario + $this->imaginario * $complejo->real;
        //esto se hace para no machacar el $this->real cuando ccalculamos $this->imaginario
        $this->real = $r;
        $this->imaginario = $i; //se puede omitir
    }

    function dividir(Complejo $complejo) {
        $denominador = pow($complejo->real, 2) + pow($complejo->imaginario, 2);
        $r = ($this->real * $complejo->real + $this->imaginario * $complejo->imaginario) / $denominador;
        $i = ($this->imaginario * $complejo->real - $this->real * $complejo->imaginario) / $denominador;
        $this->real = $r;
        $this->imaginario = $i;
    }

    function __toString() {
        if ($this->imaginario >= 0) {
            return $this->real . "+" . $this->imaginario . "i";
        } else {
            return $this->real . "" . $this->imaginario . "i";
        }
    }

}

$c = new Complejo(2, 3);
$d = new Complejo(4, 9);
//echo $c->sumar($d);
//echo $c->multiplicar($d);
//echo $c->dividir($d);
//echo $c->restar($d);
//echo $c;
//echo $c->absoluto;
//echo $c->argumento;
echo $c->igual($d);

