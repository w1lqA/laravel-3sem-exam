<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов приложения.
     */
    public function register(): void
    {
        //
    }

    /**
     * Загрузка сервисов приложения.
     */
    public function boot(): void
    {
        Blade::directive('thingStatus', function ($expression) {
            return "<?php 
                \$thing = {$expression};
                
                \$inRepair = \$thing->usages()
                    ->whereHas('place', function (\$q) {
                        \$q->where('repair', true);
                    })->exists();
                
                \$inWork = \$thing->usages()
                    ->whereHas('place', function (\$q) {
                        \$q->where('work', true);
                    })->exists();
                
                if (\$inRepair) {
                    echo '<span class=\"px-3 py-1 text-xs font-mono rounded-full border bg-yellow-500/20 text-yellow-400 border-yellow-500/30\">В ремонте</span>';
                } elseif (\$inWork) {
                    echo '<span class=\"px-3 py-1 text-xs font-mono rounded-full border bg-lime-400/20 text-lime-400 border-lime-400/30\">В работе</span>';
                } else {
                    echo '<span class=\"px-3 py-1 text-xs font-mono rounded-full border bg-neutral-500/20 text-neutral-400 border-neutral-700\">В хранилище</span>';
                }
            ?>";
        });
    }
}