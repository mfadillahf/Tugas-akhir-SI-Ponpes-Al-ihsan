<?php

namespace App\Providers;

use App\Models\Santri;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
/**
   * Register services.
   */
public function register(): void
{
    //
}

  /**
   * Bootstrap services.
   */
    public function boot(): void
        {
            View::composer('*', function ($view) {
            $menu = [(object)['menu' => []], (object)['menu' => []]];
        
        if (Auth::check() && method_exists(Auth::user(), 'getRoleNames')) {
            $user = Auth::user();
            $role = $user->getRoleNames()->first();

            $verticalPath = resource_path("menu/{$role}/verticalMenu.json");
            $horizontalPath = resource_path("menu/{$role}/horizontalMenu.json");

            if ($role === 'santri') {
                $santri = Santri::where('id_user', $user->id_user)->first();


                if (!$santri || $santri->status !== 'santri') {
                    $verticalPath = resource_path("menu/{$role}/verticalMenu_calon.json");
                    $horizontalPath = resource_path("menu/{$role}/horizontalMenu_calon.json");
                }
            }

            if (file_exists($verticalPath) && file_exists($horizontalPath)) {
                $menu = [
                    json_decode(file_get_contents($verticalPath)),
                    json_decode(file_get_contents($horizontalPath))
                ];
            } else {
                logger()->warning("Menu file tidak ditemukan untuk role '{$role}'.");
            }
        }

        $view->with('menuData', $menu);
    });
    }
}
