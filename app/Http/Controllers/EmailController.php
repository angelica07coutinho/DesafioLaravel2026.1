<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class EmailController extends Controller
{
    public function email(Request $request, User $user)
    {
        $request->validate([
            'assunto' => ['required', 'string', 'max:255'],
            'mensagem' => ['required', 'string'],
        ]);

        Mail::to($user->email, $user->name)->send(new Email([
            'nome' => Auth::user()->name,
            'email' => Auth::user()->email,
            'assunto' => $request->assunto,
            'mensagem' => $request->mensagem,
        ]));

        return redirect()->back()->with('success', 'Email enviado com sucesso!');
    }
}
