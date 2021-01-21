<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () { return redirect('/'); });

    Route::get('/password', 'UpdatePasswordController@index')->name('password');
    Route::put('/password', 'UpdatePasswordController@update');

    Route::get('/resultado', 'ResultadoController@index')->name('resultado');

    Route::group(['prefix'=>'/relatorios', 'namespace' => 'Relatorios'], function (){
        Route::get('/absenteismo-total', 'AbsenteismoTotalController@index');
        Route::get('/absenteismo-departamento', 'AbsenteismoDepartamentoController@index');
        Route::get('/absenteismo-unidade', 'AbsenteismoUnidadeController@index');
        Route::get('/dias-afastamento', 'DiasAfastamentoController@index');
    });

    Route::group(['prefix'=>'/graficos', 'namespace' => 'Graficos'], function (){
        Route::group(['prefix'=>'/atestados'], function (){
            Route::get('', 'AtestadosController@index');
            Route::get('/getdata', 'AtestadosController@returnDataTables');
            Route::get('/totalQtdDias', 'AtestadosController@totalQtdDias');
            Route::get('/qtdAtestadosPorHosp', 'AtestadosController@qtdAtestadosPorHosp');
            Route::get('/qtdDiasPerdidosPorHosp', 'AtestadosController@qtdDiasPerdidosPorHosp');
            Route::get('/topCincoQtdAtestados', 'AtestadosController@topCincoQtdAtestados');
            Route::get('/topCincoQtdDiasPerdidos', 'AtestadosController@topCincoQtdDiasPerdidos');
        });
        Route::group(['prefix'=>'/covid'], function (){
            Route::get('', 'CovidController@index');
            Route::get('/getdata', 'CovidController@returnDataTables');
            Route::get('/totalCasosCovid', 'CovidController@totalCasosCovid');
            Route::get('/qtdDiasPerdidosMes', 'CovidController@qtdDiasPerdidosMes');
        });
        Route::group(['prefix'=>'/funcao'], function (){
            Route::get('', 'FuncaoController@index');
            Route::get('/getdata', 'FuncaoController@returnDataTables');
            Route::get('/totalAtestados', 'FuncaoController@totalAtestados');
            Route::get('/qtdDiasPerdidosMes', 'FuncaoController@qtdDiasPerdidosMes');
        });
        Route::group(['prefix'=>'/cid'], function (){
            Route::get('', 'CidController@index');
            Route::get('/getdata', 'CidController@returnDataTables');
            Route::get('/totalAtestados', 'CidController@totalAtestados');
            Route::get('/qtdDiasPerdidosMes', 'CidController@qtdDiasPerdidosMes');
        });
        // Route::group(['prefix'=>'/inss'], function (){
        //     Route::get('', 'InssController@index');
        //     Route::get('/getdata', 'InssController@returnDataTables');
        // });
    });


    Route::group(['prefix'=>'/pesquisa', 'namespace' => 'Pesquisa'], function (){
        Route::get('/nome', 'PesquisaController@nome');
        Route::get('/hospital', 'PesquisaController@hospital');
        Route::get('/cid', 'PesquisaController@cid');
        Route::get('/cidCategoria', 'PesquisaController@cidCategoria');
        Route::get('/cidSubCategoria', 'PesquisaController@cidSubCategoria');
    });

    Route::get('/form', 'FormController@index')->name('home');
    Route::get('/form2', 'FormController@form2');
    Route::get('/form/getdata', 'FormController@getdata');
    Route::post('/form', 'FormController@create');
    Route::put('/form', 'FormController@update');
    Route::delete('/form', 'FormController@delete');
    Route::post('/editTel', 'FormController@editTel');
    Route::post('/atestadoFile', 'FormController@atestadoFile');
    Route::post('/atestadoFormResult', 'FormController@atestadoFormResult');

    Route::get('/datas', 'DatasController@index')->name('datas');
    Route::get('/atestadoHistoricoDatas', 'DatasController@atestadoHistoricoDatas');

    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'UserController@index')->name('admin_users');
        Route::post('/usersCreate', 'UserController@create');
        Route::post('/users', 'UserController@update');
        Route::put('/users', 'UserController@update');
        Route::delete('/users', 'UserController@remove');
        Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
    });

    Route::get('/colegas', 'ColegasController@index');
    Route::post('/colegas', 'ColegasController@form')->name('colegas');
    Route::get('/colegas/importar', 'ColegasController@import');
    Route::post('/colegas/sendFile', 'ColegasController@sendFile')->name('colegasSendFile');

});

Auth::routes();

Route::get('/', function () { return redirect('/form'); });
Route::get('/index', function () { return redirect('/form'); });

// Route::get('/login', function () { return redirect('/aviso'); })->name('login');
// Route::get('/aviso', function () { return view('aviso'); })->name('aviso');
/** para o aviso editar arquivo App\Exceptions\Handler */
