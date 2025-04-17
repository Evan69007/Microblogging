<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // Réinitialise la base à chaque test
use Illuminate\Foundation\Testing\WithFaker;        // Pour générer de fausses données (non utilisé ici)
use App\Models\User;                                // Modèle User utilisé pour vérifier l'enregistrement
use Tests\TestCase;                                 // Classe de base des tests Laravel

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // Vide la BDD entre chaque test pour garantir un environnement propre

    /**
     * 🧪 Teste la création d’un utilisateur via la route 'users.store'
     */
    public function test_create_users()
    {
        // Simulation d’un appel POST à la route 'users.store' avec des données utilisateur
        $response = $this->post(route('users.store'), [
            'name' => 'Jacque',
            'email' => 'j@test.com',
            'password' => 'admin' // ⚠️ Non hashé ici, mais suffisant pour test
        ]);

        // Vérifie qu’un utilisateur a bien été inséré dans la base de données
        $this->assertCount(1, User::all());

        // Tu pourrais aussi vérifier les données avec : $this->assertEquals('Jacque', User::first()->name);

        // Vérifie qu’il y a bien une redirection (désactivée ici, mais utile si tu l’ajoutes dans le contrôleur)
        // $response->assertRedirect(route('users.index'));
    }
}
/* Ce test permet de valider automatiquement que ta route users.store :
    Fonctionne correctement
    Enregistre bien un utilisateur dans la base
    Accepte les données nécessaires (name, email, password)

✅ À quoi ça sert ?
    Garantir la fiabilité du code même après des modifications
    Repérer facilement si quelque chose casse (ex : validation, middleware, faille)
    Gagner du temps en automatisant les vérifications */