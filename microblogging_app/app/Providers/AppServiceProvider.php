<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * AppServiceProvider est l’un des nombreux *service providers* de Laravel.
 * C’est un endroit central pour enregistrer ou configurer des services globaux de ton application.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * La méthode register() est appelée **avant** que Laravel ne démarre complètement.
     * Elle sert à enregistrer des services ou des classes dans le *service container* de Laravel.
     * Exemple d’usage : lier une interface à une implémentation, enregistrer des classes personnalisées, etc.
     */
    public function register(): void
    {
        // Exemple : $this->app->bind(SomeInterface::class, SomeClass::class);
    }

    /**
     * La méthode boot() est appelée **après** que tous les services ont été enregistrés.
     * C’est ici qu’on configure des choses à l'exécution : configuration de locale, règles de validation, etc.
     */
    public function boot(): void
    {
        // Exemple : Schema::defaultStringLength(191);
    }
}

/* Ce fichier est un "fournisseur de services" (service provider), un composant fondamental dans Laravel. Il te permet de configurer des comportements globaux de ton application.
✅ Tu peux t’en servir pour :
    Enregistrer des services personnalisés
    Ajouter des fonctions globales, macros, ou observateurs
    Modifier le comportement de Laravel (comme forcer le fuseau horaire, définir un encodage par défaut, etc.)
    Étendre des packages tiers
    Gérer des bindings (liaisons) dans le conteneur d’injection de dépendances

💡 Par défaut, ce fichier est vide, mais il devient très utile dès que ton projet grandit ou que tu utilises des packages complexes. */