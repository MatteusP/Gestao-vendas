<?php

namespace App\Http\Controllers;

use App\Jobs\SendPurchaseReceipt;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14', 
            'phone' => 'required|string|max:15', 
            'email' => 'required|email|max:255',
            'coupon_code' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
        ]);

        // Iniciar transação para garantir consistência
        DB::beginTransaction();

        try {
            // Criar uma nova venda
            $sale = Sales::create([
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'total_price' => $validatedData['total_price'],
                'customer_name' => $validatedData['name'],
                'customer_cpf' => $validatedData['cpf'],
                'customer_phone' => $validatedData['phone'],
                'customer_email' => $validatedData['email'],
                'coupon_code' => $validatedData['coupon_code'],
                'user_id' => Auth::id(),
                'status' => $validatedData['status'] ?? 'pending', // Define status padrão como 'pending'
            ]);

            // Confirmar a transação
            DB::commit();

            // Preparar dados para o email
            $purchaseData = [
                'name' => $request->name,
                'product_name' => $sale->product->name,
                'quantity' => $validatedData['quantity'],
                'total_price' => $sale->total_price,
                'email' => $validatedData['email'],
            ];

            // Disparar o Job
            SendPurchaseReceipt::dispatch($purchaseData);

            // Retornar resposta em JSON
            return back()->with('success', 'Venda criada com sucesso!');

        } catch (\Exception $e) {
            // Em caso de erro, reverter a transação
            DB::rollBack();

            // Retornar mensagem de erro
            return response()->json(['error' => 'Erro ao criar a venda!', 'message' => $e->getMessage()], 500);
        }
    }
}
