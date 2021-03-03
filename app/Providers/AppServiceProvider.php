<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;

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
        view()->composer(
            'admin.products.*',
            function ($view) {
                $view->with('categories', Category::pluck('title', 'id'));
            }
        );
        view()->composer(
            'admin.orders.*',
            function ($view) {
                $view->with('products', Product::pluck('name', 'id'));
            }
        );
        view()->composer(
            'admin.orders.*',
            function ($view) {
                $status = [1 => 'Aguardando Pagamento', 2 => 'Teste2', 3 => 'Teste3', 4 => 'Teste4'];
                $view->with('status', $status);
            }
        );
        view()->composer(
            'admin.orders.*',
            function ($view) {
                $payments = [1 => "Dinheiro", 2 => "Cartão Débito", 3 => "Cartão Crédito", 4 => "Boleto"];
                $view->with('payments', $payments);
            }
        );
    }
}
