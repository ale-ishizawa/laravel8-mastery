<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello-world', [\App\Http\Controllers\HelloWorldController::class, 'helloWorld']);

//Parâmetros dinâmicos
//quando não for obrigatório, iniciar o parametro com um valor (null, '')
Route::get('/hello/{name?}', [\App\Http\Controllers\HelloWorldController::class, 'hello']);

Route::get('/queries/{event?}', function ($event = null) {
//   $events = \App\Models\Event::all();
//   $events = \App\Models\Event::all(['title', 'description']); //select title, description from events
//   $events = \App\Models\Event::where('id', 1); //select * from events where id = 1
   $events = \App\Models\Event::find($event); //select * from events where id = 1

    //insert into events(title, description, body, start_event) values(?, ?, ?, ?);
    //Active Record
    $event = new \App\Models\Event();
    $event->title = 'Evento via Eloquent e AR';
    $event->description = 'Descrição...';
    $event->body = 'conteúdo';
    $event->start_event = date('Y-m-d H:i:s');
    $event->slug = \Illuminate\Support\Str::slug($event->title);

    return $event->save();
});
