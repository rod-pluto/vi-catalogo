<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        /**
         * Menu dinamico baseado nas coisas lá
         */
        /*$events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $items = ProductCategory::all()->map(function (ProductCategory $page) {
                return [
                    'text' => $page['name'],
                    'url' => '/cliente/catalogo/?categoria='.$page['id']
                ];
            });

            $event->menu->add([
                'text'        => 'Catálogo de Produtos',
                'url'         => 'cliente/catalogo',
                'icon'        => 'fa fa-book',
                'submenu'     => $items
            ]);
        });*/
    }
}
