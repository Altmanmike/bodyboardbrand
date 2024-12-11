<?php

namespace App\DataFixtures;

use App\Entity\CategoryTeam;
use App\Repository\CategoryTeamRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryTeamFixtures extends Fixture
{
    public function __construct(private CategoryTeamRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de catégories d'équipes
        $categoryTeam = new CategoryTeam();
        $categoryTeam->setName('Bodyboarders');
        $categoryTeam->setDescription('Représenter la marque dans les compétitions, les événements, et sur les réseaux sociaux. 
                    <br>Composition :
                    Leader de l\'équipe : Le rider principal, souvent le visage de la marque.
                    Riders internationaux : Participants réguliers aux compétitions IBA et autres grands circuits.
                    Riders locaux : Représentants régionaux pour promouvoir la marque dans des niches spécifiques (Antilles, Océan Indien, etc.).
                    Ambassadeurs : Pas forcément compétiteurs, mais influents dans la communauté bodyboard (réseaux sociaux, surf shops, etc.).
                    <br>Activités :
                    Compétitions nationales et internationales.
                    Production de contenu (vidéos, photos).
                    Sessions de test pour les nouveaux produits.'); 
        $categoryTeam->setCreatedAt(new \DateTimeImmutable());
        $categoryTeam->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryTeam);

        $categoryTeam = new CategoryTeam();
        $categoryTeam->setName('R&D');
        $categoryTeam->setDescription('Concevoir et améliorer les produits (planches, palmes, leash, etc.) en intégrant les retours des riders et les tendances du marché.
                <br>Composition :
                Ingénieurs matériaux : Pour travailler sur les stingers, les noyaux, et les revêtements.
                Designers produit : Création des designs innovants (formes, graphismes).
                Testeurs techniques : Riders impliqués dans les phases de tests intensifs.
                Responsables CAO et simulation : Pour modéliser les équipements et simuler leur comportement sur des vagues.
                <br>Activités :
                Prototypage et tests des produits.
                Innovation sur les formes et les matériaux.
                Analyse des impacts (A.R.S., Invert, etc.).
                Collaboration avec les riders pour améliorer les produits.'); 
        $categoryTeam->setCreatedAt(new \DateTimeImmutable());
        $categoryTeam->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryTeam);

        $categoryTeam = new CategoryTeam();
        $categoryTeam->setName('Marketing and Communication');
        $categoryTeam->setDescription('Assurer la visibilité et la promotion de la marque auprès des communautés locales et internationales.
                <br>Composition :
                Responsable marketing : Définition de la stratégie globale.
                Community managers : Gestion des réseaux sociaux (YouTube, Instagram, TikTok).
                Créateurs de contenu : Photographe, vidéaste, monteur.
                Relations presse : Contact avec les médias spécialisés et généralistes.
                Partenariats : Responsable des collaborations (sponsors, collaborations avec d\'autres marques).
                <br>Activités :
                Gestion des campagnes publicitaires.
                Organisation d’événements (contests, clinics).
                Création de contenu promotionnel (teasers, tutos, vlog).
                Suivi des tendances de la communauté bodyboard.'); 
        $categoryTeam->setCreatedAt(new \DateTimeImmutable());
        $categoryTeam->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryTeam);

        $categoryTeam = new CategoryTeam();
        $categoryTeam->setName('E-Commerce and Sales');
        $categoryTeam->setDescription('Gérer les ventes en ligne et maximiser les revenus.
                <br>Composition :
                Responsable e-commerce : Supervision de la boutique en ligne.
                Web développeurs : Maintenance et développement de la plateforme (ReactJS, Symfony).
                Logistique : Gestion des stocks, préparation des commandes.
                Analystes de données : Suivi des ventes et des retours clients.
                <br>Activités :
                Gestion du site e-commerce (SEO, UX).
                Lancement de nouvelles collections et promotions.
                Optimisation des process logistiques.'); 
        $categoryTeam->setCreatedAt(new \DateTimeImmutable());
        $categoryTeam->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryTeam);

        $categoryTeam = new CategoryTeam();
        $categoryTeam->setName('S.A.V');
        $categoryTeam->setDescription('Offrir un support client de qualité et traiter les demandes des clients et partenaires.
                <br>Composition :
                Responsables support : Traitement des tickets clients (retours, réparations, etc.).
                Techniciens produits : Pour les réparations et conseils techniques.
                Ambassadeurs service : Riders ou experts disponibles pour des tutoriels en ligne ou des FAQ.
                <br>Activités :
                Suivi des commandes et réclamations.
                Conseils personnalisés pour les clients.
                Organisation d\'ateliers et webinaires pour expliquer les produits.'); 
        $categoryTeam->setCreatedAt(new \DateTimeImmutable());
        $categoryTeam->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryTeam);

        $categoryTeam = new CategoryTeam();
        $categoryTeam->setName('Administration and Staff');
        $categoryTeam->setDescription('Assurer la bonne gestion de l’entreprise sur le plan administratif et financier.
                <br>Composition :
                Directeur général : Superviseur de toutes les équipes.
                Responsable RH : Gestion des membres et des recrutements.
                Responsable financier : Gestion des budgets et investissements.
                <br>Activités :
                Planification stratégique.
                Gestion des contrats des riders et des employés.
                Recherche de financements ou investisseurs.'); 
        $categoryTeam->setCreatedAt(new \DateTimeImmutable());
        $categoryTeam->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryTeam);

        $manager->flush();
 
    }
}
