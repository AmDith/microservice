<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Client;
use App\Entity\Demande;
use App\Entity\Dette;
use App\Entity\DemandeArticle;
use App\Entity\Paiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Fixtures for Articles
        for ($i = 1; $i <= 5; $i++) {
            $article = new Article();
            $article->setLibelle("Article $i")
                    ->setPrix(10.5 * $i)
                    ->setQteStock(100 * $i);

            $manager->persist($article);
        }

        // Fixtures for Clients
        for ($i = 1; $i <= 5; $i++) {
            $client = new Client();
            $client->setNom("Nom $i")
                   ->setPrenom("Prenom $i")
                   ->setTel("012345678$i")
                   ->setAdresse("Adresse $i");

            $manager->persist($client);
        }

        // Fixtures for Demandes
        for ($i = 1; $i <= 5; $i++) {
            $demande = new Demande();
            $demande->setMontant(50.0 * $i);

            $manager->persist($demande);
        }

        // Fixtures for Dettes
        for ($i = 1; $i <= 5; $i++) {
            $dette = new Dette();
            $dette->setMontant(200.0 * $i)
                  ->setMontantVerser(50.0 * $i)
                  ->setMontantRestant(150.0 * $i);

            $manager->persist($dette);
        }

        // Fixtures for DemandeArticles
        for ($i = 1; $i <= 5; $i++) {
            $demandeArticle = new DemandeArticle();
            $demandeArticle->setSomme(20.0 * $i)
                           ->setQteDemande(2 * $i);

            $manager->persist($demandeArticle);
        }

        // Fixtures for Paiements
        for ($i = 1; $i <= 5; $i++) {
            $paiement = new Paiement();
            $paiement->setMontant(100.0 * $i);

            $manager->persist($paiement);
        }

        // Flush all fixtures to the database
        $manager->flush();
    }
}
