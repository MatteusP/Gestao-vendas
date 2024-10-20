<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Filtro por nome (opcional)
        $search = $request->input('search');

        // Busca produtos, com filtro pelo nome se aplicável
        $products = Product::when($search, function($query, $search) {
            return $query->where('name', 'ilike', '%' . $search . '%');
        })->orderByDesc('created_at')
        ->paginate(10);

        // Passa os produtos e o termo de busca para a view
        return view('products.index', compact('products', 'search'));
    
    }

    public function show(Product $product)
    {
        // Salvando log
        Log::info('Visualizar produto.', ['user_id' => Auth::id(), 'product_id' => $product->id]);

        // Carregar a view
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        $categories = Category::all();
        // Salvando log
        Log::info('Carregar formulário para cadastrar produto.', ['user_id' => Auth::id()]);

        // Carregar a view
        return view('products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // Validando o formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string', // Verifica se a categoria existe
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida a imagem
        ]);
    
        // Iniciar transação
        DB::beginTransaction();
    
        try {
            // Processa o upload da imagem
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Gera um nome único para a imagem
            $image->move(public_path('images/products'), $imageName); // Armazena a imagem na pasta public/images/products
    
            // Cadastrando no banco de dados
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'purchase_price' => $request->purchase_price, // Preço de compra
                'sale_price' => $request->sale_price, // Preço de venda
                'stock_quantity' => $request->quantity, // Quantidade em estoque
                'category' => $request->category, // Armazena a categoria
                'image' => $imageName, // Nome da imagem sem caminho
                'created_by' => Auth::id(),
            ]);
    
            // Salvando log
            Log::info('Produto cadastrado.', ['id' => $product->id, 'user_id' => Auth::id()]);
    
            // Confirmar transação
            DB::commit();
    
            // Redirecionar sem mensagem
            return redirect()->route('products.index');
        } catch (Exception $e) {
            // Reverter transação
            DB::rollBack();
    
            // Salvando log
            Log::error('Erro ao cadastrar produto.', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);
    
            // Retornar erro
            return back()->withInput()->with('error', 'Produto não cadastrado!');
        }
    }
    
    

    public function edit(Product $product)
    {
        // Salvando log
        Log::info('Carregar formulário para editar produto.', ['id' => $product->id, 'user_id' => Auth::id()]);

        // Carregar a view
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        // Validando o formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        // Iniciar transação
        DB::beginTransaction();

        try {
            // Atualizar informações no banco de dados
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now(),
            ]);

            // Salvando log
            Log::info('Produto atualizado.', ['id' => $product->id, 'user_id' => Auth::id()]);

            // Confirmar transação
            DB::commit();

            // Redirecionar e enviar mensagem de sucesso
            return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
        } catch (Exception $e) {
            // Reverter transação
            DB::rollBack();

            // Salvando log
            Log::error('Erro ao atualizar produto.', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);

            // Retornar erro
            return back()->withInput()->with('error', 'Produto não atualizado!');
        }
    }

    public function destroy(Product $product)
    {
        try {
            // Atualizando registro para indicar quem deletou
            $product->deleted_by = Auth::id();
            $product->save();

            // Excluir produto
            $product->delete();

            // Salvando log
            Log::info('Produto apagado.', ['id' => $product->id, 'user_id' => Auth::id()]);

            // Redirecionar e enviar mensagem de sucesso
            return redirect()->route('products.index')->with('success', 'Produto apagado com sucesso!');
        } catch (Exception $e) {
            // Salvando log
            Log::error('Erro ao apagar produto.', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);

            // Redirecionar com mensagem de erro
            return redirect()->route('products.index')->with('error', 'Produto não apagado!');
        }
    }
}
