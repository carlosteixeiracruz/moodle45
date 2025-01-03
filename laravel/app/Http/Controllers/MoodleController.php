<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoodleController extends Controller
{
    public function login(Request $request)
    {
        echo "lorem";
        // Valide as credenciais
        #$credentials = $request->only('username', 'password');
        
        // Aqui você pode integrar a autenticação com o Moodle, por exemplo:
        // $user = Auth::attempt($credentials);

        // Supondo que o login foi bem-sucedido:
        #return redirect()->route('dashboard');  // Redireciona para o dashboard após o login
        
        // Ou se falhar:
        #return back()->withErrors(['login_failed' => 'Credenciais inválidas']);
    }
}
