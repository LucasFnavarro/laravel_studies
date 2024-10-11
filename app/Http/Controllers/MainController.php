<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // ===============================================================
    public function index()
    {
        echo "Index";
    }

    // ===============================================================
    public function about()
    {
        echo "About";
    }

    // ===============================================================
    public function mostrarValor($valor)
    {
        echo "Valor enviado pela rota: $valor";
    }

    // ===============================================================
    public function mostrarValores($valor1, $valor2)
    {
        echo "Valores enviado pela rota: $valor1 - $valor2";
    }

    // ===============================================================
    public function mostrarValores2(Request $request, $valor1, $valor2)
    {
        echo "Valores enviado pela rota: $valor1 - $valor2";
    }

    // ===============================================================
    public function mostrarValorOpcional($valor = null)
    {
        echo "Valores opcional: $valor";
    }

    // ===============================================================
    public function mostrarValorOpcional2($valor1, $valor2 = 100)
    {
        echo "Valor opcional: $valor1 e $valor2";
    }
}
