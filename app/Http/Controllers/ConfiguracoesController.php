<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\Usuario;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadesPassword;

use function Laravel\Prompts\password;

class ConfiguracoesController extends Controller
{
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();


        return view('pages.aluno.configuracoes-aluno', compact('user'));
    }
    public function updatedProfile(Request $request)
    {
        /** @var \App\Models\Usuario $user */
        $user = Auth::user();


        $request->validate([
            'name' => 'required|string|max:65',
            'email' => [
                'required',
                'string',
                'max:70',
                Rule::unique('usuarios')->ignore($user->id),
            ],
            'current_password' => [
                'nullable',
                'required_with:password',
                'current_password', // <- regra nativa do Laravel
            ],

            // Nova senha
            'password' => [
                'nullable',
                'confirmed', // precisa de password_confirmation
                Password::min(6),
                'different:current_password',
            ],
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        if ($request->hasFile('profilePicture')) {
            if ($user->foto_perfil) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            $path = $request->file('profilePicture')->store('fotos_perfil', 'public');
            $user->foto_perfil = $path;
        }


        $user->save();


        return redirect()->route('aluno.configuracoes-aluno')->with('success', 'Perfil atualizado com sucesso!');
    }


    public function deactivateAccount(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->active_user = false;
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Sua conta foi desativada');
    }
}
