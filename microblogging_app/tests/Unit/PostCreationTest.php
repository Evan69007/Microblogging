<?php

namespace Tests\Unit;

use Tests\TestCase;                          // Classe de base pour tous les tests Laravel
use App\Models\Post;                         // Modèle Post
use App\Models\User;                         // Modèle User
use Illuminate\Foundation\Testing\RefreshDatabase; // Pour réinitialiser la BDD entre les tests

class PostCreationTest extends TestCase
{
    use RefreshDatabase; // Vide et recrée la BDD à chaque test pour assurer un environnement propre

    /**
     * 🧪 Test unitaire de base : création d’un post
     */
    public function testPostCreation()
    {
        // Création manuelle d’un utilisateur (qui publiera le post)
        $user = User::create([
            'name' => 'Jacque',
            'email' => 'j@test.com',
            'password' => 'admin' // ⚠️ Non hashé ici (pas nécessaire pour ce test simple)
        ]);

        // Création d’un post lié à l'utilisateur
        $post = Post::create([
            'user_id' => $user->id, // On lie le post à l'utilisateur créé juste au-dessus
            'titre' => 'Sample Post Title',
            'description' => 'Sample Post Description',
        ]);

        // Récupère le post depuis la base pour vérifier qu’il a bien été enregistré
        $createdPost = Post::find($post->id);

        // Vérifie que le post existe bien
        $this->assertNotNull($createdPost);

        // Vérifie que le titre du post correspond à celui qu’on a créé
        $this->assertEquals('Sample Post Title', $createdPost->titre);
    }
}

/* Ce test unitaire sert à vérifier que ton modèle Post peut correctement :
    Être créé en base de données
    Être récupéré par son ID
    Contenir les bonnes données (ex. : le titre)

✅ Pourquoi c’est utile :
    Pour valider le bon fonctionnement du modèle indépendamment du contrôleur ou des routes
    Pour tester la logique métier sans passer par l’interface utilisateur
    Pour te prémunir contre les régressions si tu modifies ton modèle plus tard */