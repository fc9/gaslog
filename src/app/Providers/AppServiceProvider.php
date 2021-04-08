<?php

namespace App\Providers;

use BenSampo\Enum\Enum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerIncludes();
        $this->registerValidations();
        $this->registerObservers();
        $this->registerPaginator();
        $this->registerMacros();
    }

    protected function registerValidations()
    {
        Validator::extend('youtube_url', 'App\Validators\YoutubeUrlValidator@validate');
        Validator::extend('instagram_url', 'App\Validators\InstagramUrlValidator@validate');
        Validator::extend('facebook_url', 'App\Validators\FacebookUrlValidator@validate');
        Validator::extend('required_checkbox', 'App\Validators\RequiredCheckboxValidator@validate');
        Validator::extend('base64_image', 'App\Validators\Base64ImageValidator@validate');
        Validator::extend('base64_doc', 'App\Validators\Base64DocValidator@validate');
        Validator::extend('base64_mixed', 'App\Validators\Base64MixedValidator@validate');
        Validator::extend('cep', 'App\Validators\CepValidator@validate');
        Validator::extend('cnpj', 'App\Validators\CnpjValidator@validate');
        Validator::extend('cnpj_format', 'App\Validators\CnpjFormatValidator@validate');
        Validator::extend('cpf', 'App\Validators\CpfValidator@validate');
        Validator::extend('cpf_format', 'App\Validators\CpfFormatValidator@validate');
        Validator::extend('phone', 'App\Validators\PhoneValidator@validate');
    }

    protected function registerIncludes()
    {
        $path = 'stage.includes.';
        Blade::include($path . 'radio-input', 'radioInput');
        Blade::include($path . 'form-item-textarea', 'formItemTextarea');
    }

    protected function registerObservers()
    {
        \App\Models\User::observe(\App\Observers\UserObserver::class);
    }

    protected function registerPaginator()
    {
    }

    protected function registerMacros()
    {
        Enum::macro('all', function() {
            $collection = [];

            foreach (self::getValues() as $value) {
                $collection[] = self::fromValue($value);
            }

            return $collection;
        });
    }
}
