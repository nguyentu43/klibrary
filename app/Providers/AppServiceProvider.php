<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\EbookConvert;
use App\DeviceType;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::if('admin', function(){
            return Auth::check() && Auth::user()->isAdmin;
        });

        Blade::if('route', function($name){
            return strstr(Route::currentRouteName(), $name) !== false;
        });

        Book::deleted(function($book){
            if($book->isForceDeleting())
            {
                $files = [ 'public/covers/'.$book->id.'.jpg' ];
                if($book->formats !== null)
                {
                    foreach($book->formats as $format)
                    {
                        array_push($files, 'ebooks/'.$book->id.'.'.$format);
                    }
                }
                
                Storage::delete($files);
            }
        });

        Validator::extend('ebooktypes', function($attribute, $value, $parameters, $validator){
            return in_array($value->getClientOriginalExtension(), EbookConvert::$supportTypes);
        });

        Validator::replacer('ebooktypes', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':values', implode(', ', EbookConvert::$supportTypes), $message);
        });

        view()->share('supportTypes', EbookConvert::$supportTypes);
        view()->share('supportDevices', DeviceType::getAllDeviceName());
    }
}
