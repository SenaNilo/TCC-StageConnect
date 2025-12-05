<?php

namespace App\Http\Controllers;

use App\Notifications\ContactFormNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'mensagem' => 'required|string|min:10',
        ], [
            'mensagem.required' => 'Por favor, escreva uma mensagem.',
            'mensagem.min' => 'Sua mensagem é muito curta. Escreva pelo menos 10 caracteres.',
            'email.email' => 'Insira um e-mail válido.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('contato');
        }

        // Se passou, pegamos os dados validados
        $validatedData = $validator->validated();

        $recipientEmail = env('MAIL_FROM_ADDRESS', 'stageconnect8@gmail.com');

        $notifiable = new class {
            use \Illuminate\Notifications\Notifiable;

            public function routeNotificationForMail($notification)
            {
                return env('MAIL_TO_RECIPIENT', 'stageconnect8@gmail.com');
            }
        };

        $notificationData = array_merge($validatedData, [
            'telefone' => $request->input('telefone'),
        ]);

        Notification::send($notifiable, new ContactFormNotification($notificationData));

        return redirect('/obrigado')->with('success', 'Mensagem enviada com sucesso! Em breve entraremos em contato.');
    }
}
