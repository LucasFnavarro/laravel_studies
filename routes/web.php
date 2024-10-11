<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyAdmin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// assinatura de uma rota
// Route::verb('uri', 'callback'); - o callback é a ação que vai ser executada quando chamar a rota uri

Route::view('/', 'home');

// chama a view, passa para a home e atribui uma variavel myName que pode usar no front.
Route::view('/view', 'home', ['myName' => "Lucas Felipe"]);

// rota com função anônima
Route::get('/rota', function () {
    return '<h1>Olá, Laravel!</h1>';
});

Route::get('/user', function () {
    return '<h1>Aqui está o usuário</h1>';
});

Route::get('/injection', function (Request $req) {
    echo "<pre>";
    var_dump($req);
});

//aceita get e post
Route::match(['get', 'post'], '/match', function (Request $req) {
    return '<h1>Aceita GET e POST</h1>';
});

// Aceita qualquer tipo de método
Route::any('/any', function (Request $req) {
    return '<h1>Aceita qualquer HTTP VERB</h1>';
});


Route::get('/index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);
Route::redirect('/saltar', '/index');
Route::permanentRedirect('/saltar2', '/index');


// ===============================================================
// ROUTE PARAMETERS
// ===============================================================
Route::get('/valor/{value}', [MainController::class, 'mostrarValor']);
Route::get('/valores/{value1}/{value2}', [MainController::class, 'mostrarValores']);
Route::get('/valores2/{value1}/{value2}', [MainController::class, 'mostrarValores2']);

Route::get('/opcional/{value?}', [MainController::class, 'mostrarValorOpcional']);
Route::get('/opcional1/{value1}/{value2?}', [MainController::class, 'mostrarValorOpcional2']);


// ===============================================================
// ROUTE PARAMETERS WITH CONSTRAINTS
// ===============================================================
Route::get('/exp1/{value}', function ($value) {
    echo $value;
})->where('value', '[A-Za-z0-9/]+'); // regra de expressão regular

Route::get('/exp2/{value1}{value2}', function ($value) {
    echo $value;
})->where(
    [
        'value1' => '[0-9]+',
        'value2' => '[A-Za-z0-9]+'
    ]
); // regra de expressão regular



// ===============================================================
// ROUTE NAMES
// ===============================================================
Route::get('/rota_abc', function(){
    return 'Rota nomeada => referenciada';
})->name('rota_nomeada');


Route::get('/rota_referenciada', function(){
    return redirect()->route('rota_nomeada');
});

Route::prefix('admin')->group(function(){
    Route::get('/home', [MainController::class, 'index']);
    Route::get('/about', [MainController::class, 'about']);
    Route::get('/management', [MainController::class, 'mostrarValor']);
});

/*
admin/home
admin/about
admin/management
*/

// ===============================================================
// ROUTE MIDDLEWARES
// ===============================================================
Route::get('/admin/only', function(){
    echo 'Apenas Administradores';
})->middleware([OnlyAdmin::class]);


Route::middleware([OnlyAdmin::class])->group(function(){
    Route::get('/admin/only2', function(){
        return 'Apenas Administradores 2';
    });

    Route::get('/admin/only3', function(){
        return 'Apenas para administradores 3';
    });
});

// ===============================================================
// ROUTE CONTROLLERS
// ===============================================================

// Route::get('/new', [UserController::class, 'new']);
// Route::get('/edit', [UserController::class, 'edit']);
// Route::get('/delete', [UserController::class, 'delete']);

Route::controller(UserController::class)->group(function(){
    Route::get('/user/new', 'new');
    Route::get('/user/edit', 'edit');
    Route::get('/user/delete', 'delete');
});


Route::fallback(function(){
    return '404 - Página não encontrada';
});
