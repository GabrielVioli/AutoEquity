<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class carController extends Controller
{
    private function parseMoney($valor) {
        if (!$valor) return 0;
        $limpo = str_replace(['R$', '.', ' '], '', $valor);
        $limpo = str_replace(',', '.', $limpo);
        return (float) $limpo;
    }

    public function index() {
        $cars = Car::where('user_id', auth()->id())->get();

        $totalPatrimonio = 0;
        $carroMaisValioso = null;
        $maiorValor = 0;

        foreach($cars as $car) {
            $valorNumerico = $this->parseMoney($car->valor);

            $totalPatrimonio += $valorNumerico;

            if ($valorNumerico > $maiorValor) {
                $maiorValor = $valorNumerico;
                $carroMaisValioso = $car;
            }
        }

        $totalPatrimonioFormatado = 'R$ ' . number_format($totalPatrimonio, 2, ',', '.');

        return view('cars.garage', compact('cars', 'totalPatrimonioFormatado', 'carroMaisValioso'));
    }

    public function store(Request $request) {
        $dados = $request->validate([
            'fipe_codigo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano_modelo' => 'required',
            'combustivel' => 'required',
            'valor' => 'required',
            'mes_referencia' => 'required',
            'sigla_combustivel' => 'nullable',
        ]);

        auth()->user()->cars()->create($dados);

        return redirect()->route('garage.index');
    }

    public function destroy($id) {
        $car = Car::findOrFail($id);

        if ($car->user_id == auth()->id()) {
            $car->delete();
        }

        return redirect()->route('garage.index');
    }
}
