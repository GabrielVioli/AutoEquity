<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Car;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index() {
        return view('monitor.welcome');
    }


    public function dashboard() {
        $carsMarcas = Http::get('https://parallelum.com.br/fipe/api/v1/carros/marcas')->json();


        return view('home', compact('carsMarcas'));
    }

    public function modelos(Request $request) {
        $codigoMarca = $request->get('marca');

        $carsModels = Http::get("https://parallelum.com.br/fipe/api/v1/carros/marcas/{$codigoMarca}/modelos")->json();
        $listaModelos = $carsModels['modelos'];

        return view('modelos', compact('listaModelos', 'codigoMarca'));
    }


    public function anos(Request $request) {
        $codigoMarca = $request->get('marca');
        $codigoModelo = $request->get('codigo');

        $carsAnos = Http::get("https://parallelum.com.br/fipe/api/v1/carros/marcas/{$codigoMarca}/modelos/{$codigoModelo}/anos")->json();
        $listaAnos = $carsAnos;

        return view('anos', compact('listaAnos', 'codigoMarca', 'codigoModelo'));
    }

    public function detalhes(Request $request) {
        $codigoMarca = $request->get('marca');
        $codigoModelo = $request->get('modelo');
        $codigoAno = $request->get('ano');

        $response = Http::get("https://parallelum.com.br/fipe/api/v1/carros/marcas/{$codigoMarca}/modelos/{$codigoModelo}/anos/{$codigoAno}")->json();
        $veiculo = $response;

        return view('detalhes', compact('veiculo'));
    }

    public function analise($id) {
        $car = Car::where('user_id', auth()->id())->findOrFail($id);

        $historico = Http::get("https://brasilapi.com.br/api/fipe/preco/v1/{$car->fipe_codigo}")->json();

        if (!is_array($historico) || empty($historico) || isset($historico['message'])) {
            return redirect()->route('garage.index');
        }

        $labels = [];
        $data = [];

        $historicoReverso = array_reverse($historico);

        foreach($historicoReverso as $registro) {
            $labels[] = $registro['mesReferencia'];

            $valorLimpo = str_replace(['R$', '.', ' '], '', $registro['valor']);
            $valorLimpo = str_replace(',', '.', $valorLimpo);
            $data[] = (float) $valorLimpo;
        }

        $precoAtual = end($data);

        $precoAnterior = count($data) > 1 ? prev($data) : $precoAtual;

        $variacao = $precoAtual - $precoAnterior;

        if ($precoAnterior > 0) {
            $porcentagem = ($variacao / $precoAnterior) * 100;
        } else {
            $porcentagem = 0;
        }

        return view('dashboard.analise', compact('car', 'labels', 'data', 'variacao', 'porcentagem', 'precoAtual'));
    }
}
