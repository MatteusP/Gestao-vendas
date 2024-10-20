<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {

        // Recupera os registros do banco de dados
        $users = User::when($request->has('name'), function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'ilike', '%' . $request->name . '%');
        })->when($request->has('email'), function ($whenQuery) use ($request) {
            $whenQuery->where('email', 'ilike', '%' . $request->email . '%');
        })
            ->orderByDesc('id')->paginate(10)->withQueryString();

        // Realizando a soma do total de registros
        $totalRecords = User::when($request->has('name'), function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'ilike', '%' . $request->name . '%');
        })->when($request->has('email'), function ($whenQuery) use ($request) {
            $whenQuery->where('email', 'ilike', '%' . $request->email . '%');
        })->count();

        // Carregar a view
        return view('users.index', ['menu' => 'users', 'users' => $users, 'name' => $request->name, 'email' => $request->email, 'data_cadastro_inicio' => $request->data_cadastro_inicio, 'data_cadastro_fim' => $request->data_cadastro_fim, 'totalRecords' => $totalRecords]);
    }
    public function show(User $user)
    {
        // Salvando log
        Log::info('Visualizar usuário.', ['user_id' => Auth::id(), 'user_id' => $user->id]);

        // Carregar a view
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        // Salvando log
        Log::info('Carregar formulário para editar usuário.', ['id' => $user->id, 'user_id' => Auth::id()]);

        // Carregar a view
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        // Validando o formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Iniciar transação
        DB::beginTransaction();

        try {
            // Atualizar informações no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'updated_by' => Auth::id(),
                'updated_at' => Carbon::now(),
            ]);

            // Salvando log
            Log::info('Usuário atualizado.', ['id' => $user->id, 'user_id' => Auth::id()]);

            // Confirmar transação
            DB::commit();

            // Redirecionar e enviar mensagem de sucesso
            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (Exception $e) {
            // Reverter transação
            DB::rollBack();

            // Salvando log
            Log::error('Erro ao atualizar usuário.', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);

            // Retornar erro
            return back()->withInput()->with('error', 'Usuário não atualizado!');
        }
    }

    public function destroy(User $user)
    {
        try {
            // Atualizando registro para indicar quem deletou
            $user->deleted_by = Auth::id();
            $user->save();

            // Excluir usuário
            $user->delete();

            // Salvando log
            Log::info('Usuário apagado.', ['id' => $user->id, 'user_id' => Auth::id()]);

            // Redirecionar e enviar mensagem de sucesso
            return redirect()->route('users.index')->with('success', 'Usuário apagado com sucesso!');
        } catch (Exception $e) {
            // Salvando log
            Log::error('Erro ao apagar usuário.', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);

            // Redirecionar com mensagem de erro
            return redirect()->route('users.index')->with('error', 'Usuário não apagado!');
        }
    }

}
