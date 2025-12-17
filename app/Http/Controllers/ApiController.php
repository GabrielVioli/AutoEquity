<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function  __invoke() {
        return Http::get('https://parallelum.com.br/fipe/api/v1/carros/marcas')->json();
    }
}
