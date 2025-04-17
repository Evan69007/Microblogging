<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // Permet de réinitialiser la BDD avant chaque test
use Illuminate\Foundation\Testing\WithFaker;        // Permet de générer des données aléatoires (non utilisé ici)
use App\Models\Post;                                // On importe le modèle Post
use App\Models\User;                                // On importe le modèle User
use Tests\TestCase;                                 // Classe de base pour tous les tests Laravel

class PostControllerTest extends TestCase
{
    use RefreshDatabase; // Réinitialise la base de données à chaque test pour éviter les interférences

    /**
     * 🧪 Teste la création d’un post par un utilisateur
     */
    public function test_create_post()
    {
        // Création d’un utilisateur fictif pour le test
        $user = User::create([
            'name' => 'Jacque',
            'email' => 'j@test.com',
            'password' => 'admin' // ⚠️ Non hashé ici, mais OK pour test simple
        ]);

        // Simulation d’un appel POST vers la route de création de post
        $response = $this->post(route('posts.store'), [
            'user_id' => 1, // ID de l’utilisateur
            'titre' => 'Sample Post Title',
            'description' => 'Sample Post Description',
        ]);

        // Vérifie qu’un post a bien été inséré en base
        $this->assertCount(1, Post::all());

        // Vérifie que l’utilisateur est redirigé après création (commenté pour l’instant)
        // $response->assertRedirect(route('posts.index'));
    }
}
/* Ce fichier fait partie des tests de fonctionnalité Laravel (dossier tests/Feature).
Il sert à vérifier que la création d’un post fonctionne bien depuis le back-end.
✅ Il permet :
    De s’assurer que l’API de création de post est fonctionnelle
    Que les données sont bien enregistrées dans la base
    Que la redirection (si active) est correcte
    De tester automatiquement, sans lancer l’interface utilisateur */
