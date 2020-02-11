<?php

Route::prefix('__testing__')->group(function(){

    //Create Model
    Route::get('create/{model}', function($model){
        return factory("App\\{$model}")->create(request()->all());
    })->name('testing.create.model');

    //Create Model
    Route::get('create/{model}/{count?}', function($model, $count=1){
        return factory("App\\{$model}", intval($count))->create(request()->all());
    })->name('testing.create.model');

    //Create Authenticable model and login
    Route::get('login/{model?}', function($model = 'User'){
        $user = factory("App\\{$model}")->create(request()->all());
        if($user instanceof \Illuminate\Foundation\Auth\User)
        {
            auth()->login($user);
        }
        return $user;
    })->name('testing.login.model');

    //Migrate Refresh
    Route::get('migrate', function(){
        Artisan::call("migrate:refresh");
    });
});

