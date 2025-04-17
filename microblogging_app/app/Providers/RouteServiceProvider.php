<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit; // Pour définir des limites de requêtes API (rate limiting)
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider; // Classe de base pour configurer les routes
use Illuminate\Http\Request; // Représente une requête HTTP
use Illuminate\Support\Facades\RateLimiter; // Fournisseur de service pour limiter les appels API
use Illuminate\Support\Facades\Route; // Accès à la définition des routes (API/web)

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Constante qui définit la route vers laquelle l’utilisateur est redirigé après authentification.
     * Elle est souvent utilisée après un login réussi.
     */
    public const HOME = '/home';

    /**
     * Méthode exécutée automatiquement au démarrage de l’application.
     * On y configure :
     * - les limites de requêtes pour l'API
     * - la déclaration des fichiers de routes (api.php, web.php, etc.)
     */
    public function boot(): void
    {
        /**
         * Définition des règles de limitation pour l'API :
         * Ici : 60 requêtes par minute par utilisateur (ou par IP si non connecté).
         * Cela protège l’API contre les abus (rate limiting).
         */
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        /**
         * Déclaration des routes de l’application :
         * - Les routes API sont définies dans routes/api.php, avec le middleware 'api' et le préfixe /api
         * - Les routes Web (HTML) sont dans routes/web.php avec le middleware 'web'
         */
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}

/* Ce fichier est un service provider spécifique de Laravel dédié à la configuration des routes.
✅ Il permet :

    De charger les fichiers de routes : routes/api.php, routes/web.php, etc.
    D’appliquer automatiquement des middleware (api, web) à chaque groupe de routes
    De configurer des règles comme :
        la limitation du nombre de requêtes par minute (anti-spam)
        les redirections par défaut après connexion
        des bindings automatiques de modèles via les routes (facultatif) */