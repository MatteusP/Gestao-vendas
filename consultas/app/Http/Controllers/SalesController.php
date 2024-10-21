<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales(Request $request)
    {
        // Validação do email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Criação do cliente Guzzle
        $client = new Client();

        // URL da API (substitua pelo seu endpoint)
        $url = 'http://127.0.0.1:8080/api/sales';

        try {
            // Fazendo a requisição GET
            $response = $client->request('GET', $url, [
                'query' => ['email' => $request->input('email')],
            ]);

            // Obtendo o corpo da resposta e decodificando JSON
            $sales = json_decode($response->getBody()->getContents());

            // Retornar a view com os dados das vendas
            return view('sales.index', ['sales' => $sales]);
        } catch (\Exception $e) {
            // Tratar erros de requisição
            return redirect()->back()->with('error', 'Erro ao buscar vendas: ' . $e->getMessage());
        }
    }
}
