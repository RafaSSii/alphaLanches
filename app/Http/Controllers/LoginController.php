<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\GuardRequest as GR;

class LoginController extends Controller
{
    public function showlogin()
    {
        return view('login');
    }
    public function showCadastro()
    {
        return view('cadastro');
    }

    public function authUser(Request $request)
    {
        $dados = $request->except('_token');

        if (!Auth::attempt($dados)) {
            return redirect()->back()->with('errorAuth', 'Email ou Senha Incorreto');
        }

        $user = Auth::user();

        switch ($user->type) {
            case 'admin':
                return redirect()->route('home.admin');
            case 'func':
                return redirect()->route('home.func');
            case 'student':
                return redirect()->route('home.student');
            case 'guard':
                return redirect()->route('home.guard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('errorAuth', 'Tipo de usuário inválido.');

        }
    }
    public function storeUser(Request $request){
        $dados = $request->except('_token');
        if($dados['confirmacao' ]== 1){
            if(GR::where('cpf',$dados['cpf'])->exists() || GR::where('email',$dados['email'])->exists() || GR::where('telefone',$dados['telefone'])->exists()){
                return redirect()->back()->with('errorAuth', 'Você já tem um pedido em aberto, qualquer dúvida entrar em contato com o administrador');
            }
            if(User::where('cpf',$dados['cpf'])->exists() || User::where('email',$dados['email'])->exists() || User::where('telefone',$dados['telefone'])->exists()){
                return redirect()->back()->with('errorAuth', 'Usuário já cadastrado, qualquer dúvida entrar em contato com o administrador');
            }
            GR::create(['name'=>$dados['name'],'email'=>$dados['email'],'telefone'=>$dados['telefone'],'cpf'=>$dados['cpf']]);
            return redirect()->route('login')->with('success', 'Request enviado com sucesso, por favor aguarde confirmação');
        }
        if($dados['password'] !== $dados['confirmPassword']){
            return redirect()->back()->with('errorAuth', 'As Senhas não são iguais');
        }
        else if(User::where('email',$dados['email'])->exists()){
            return redirect()->back()->with('errorAuth', 'Email já cadastrado');
        }
        else{
            User::Create([
                'name' => $dados['name'],
                'email'=> $dados['email'],
                'password' => bcrypt($dados['password']),
                'telefone'=> $dados['telefone'],
                'cpf'=>$dados['cpf']
            ]);
            return redirect()->route('login')->with('success', 'Cadastrado com Sucesso');
        }
  }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('successLogout', 'Sessão deslogada com sucesso');
    }
}
