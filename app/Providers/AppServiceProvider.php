<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifica tu cuenta en ' . env('APP_NAME'))
                ->greeting('¡Hola ' . $notifiable->name . '!')
                ->line('Por favor, haz click en el botón de abajo para verificar tu dirección de correo electrónico.')
                ->action('Confirmar mi correo electrónico', $url)
                ->line('Si no has creado una cuenta ignora este mensaje.')
                ->salutation(new HtmlString('Saludos,<br>El equipo de <strong>' . env('APP_NAME') . '</strong>'));
        });
    }
}
