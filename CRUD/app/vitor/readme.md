Passo 1: Configurar os Guards

Primeiro, você precisa definir múltiplos guards no arquivo de configuração config/auth.php. Por exemplo:

```php

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],

    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
```
Passo 2: Criar o Middleware Personalizado

Agora, você pode criar middlewares personalizados para cada tipo de autenticação, se necessário. Por exemplo, um middleware para administradores:

```bash

php artisan make:middleware AdminAuth
```
No middleware AdminAuth, você pode verificar a autenticação assim:

```php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        return redirect('/admin/login');
    }
}
```
Passo 3: Registrar o Middleware

Registre seu middleware no app/Http/Kernel.php:

```php

protected $routeMiddleware = [
    // outros middlewares
    'adminAuth' => \App\Http\Middleware\AdminAuth::class,
];
```
Passo 4: Aplicar os Guards nas Rotas

Agora, você pode aplicar os guards nas suas rotas. Por exemplo, se você tem rotas para usuários e administradores:

```php

// Rotas para usuários
Route::middleware('auth')->group(function () {
    // suas rotas de usuários aqui
});

// Rotas para administradores
Route::middleware('adminAuth')->group(function () {
    // suas rotas de administradores aqui
});
```