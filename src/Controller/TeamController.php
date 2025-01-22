<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index(): Response
    {
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }

    /*#[Route('/api/teams', name: 'api_team_all')]
    public function getCollection(): Response
    {
        $teams = [
            [
                'name' => 'Bodyboarders', 
                'description' => 'Représenter la marque dans les compétitions, les événements, et sur les réseaux sociaux. 
                    Composition :
                    Leader de l\'équipe : Le rider principal, souvent le visage de la marque.
                    Riders internationaux : Participants réguliers aux compétitions IBA et autres grands circuits.
                    Riders locaux : Représentants régionaux pour promouvoir la marque dans des niches spécifiques (Antilles, Océan Indien, etc.).
                    Ambassadeurs : Pas forcément compétiteurs, mais influents dans la communauté bodyboard (réseaux sociaux, surf shops, etc.).
                    Activités :
                    Compétitions nationales et internationales.
                    Production de contenu (vidéos, photos).
                    Sessions de test pour les nouveaux produits.',
            ],
            [
                'name' => 'R&D', 
                'description' => 'Concevoir et améliorer les produits (planches, palmes, leash, etc.) en intégrant les retours des riders et les tendances du marché.
                Composition :
                Ingénieurs matériaux : Pour travailler sur les stingers, les noyaux, et les revêtements.
                Designers produit : Création des designs innovants (formes, graphismes).
                Testeurs techniques : Riders impliqués dans les phases de tests intensifs.
                Responsables CAO et simulation : Pour modéliser les équipements et simuler leur comportement sur des vagues.
                Activités :
                Prototypage et tests des produits.
                Innovation sur les formes et les matériaux.
                Analyse des impacts (A.R.S., Invert, etc.).
                Collaboration avec les riders pour améliorer les produits.',
            ],
            [
                'name' => 'Marketing and Communication', 
                'description' => 'Assurer la visibilité et la promotion de la marque auprès des communautés locales et internationales.
                Composition :
                Responsable marketing : Définition de la stratégie globale.
                Community managers : Gestion des réseaux sociaux (YouTube, Instagram, TikTok).
                Créateurs de contenu : Photographe, vidéaste, monteur.
                Relations presse : Contact avec les médias spécialisés et généralistes.
                Partenariats : Responsable des collaborations (sponsors, collaborations avec d\'autres marques).
                Activités :
                Gestion des campagnes publicitaires.
                Organisation d’événements (contests, clinics).
                Création de contenu promotionnel (teasers, tutos, vlog).
                Suivi des tendances de la communauté bodyboard.',
            ],
            [
                'name' => 'E-Commerce and Sales', 
                'description' => 'Gérer les ventes en ligne et maximiser les revenus.
                Composition :
                Responsable e-commerce : Supervision de la boutique en ligne.
                Web développeurs : Maintenance et développement de la plateforme (ReactJS, Symfony).
                Logistique : Gestion des stocks, préparation des commandes.
                Analystes de données : Suivi des ventes et des retours clients.
                Activités :
                Gestion du site e-commerce (SEO, UX).
                Lancement de nouvelles collections et promotions.
                Optimisation des process logistiques.',
            ],
            [
                'name' => 'S.A.V', 
                'description' => 'Offrir un support client de qualité et traiter les demandes des clients et partenaires.
                Composition :
                Responsables support : Traitement des tickets clients (retours, réparations, etc.).
                Techniciens produits : Pour les réparations et conseils techniques.
                Ambassadeurs service : Riders ou experts disponibles pour des tutoriels en ligne ou des FAQ.
                Activités :
                Suivi des commandes et réclamations.
                Conseils personnalisés pour les clients.
                Organisation d\'ateliers et webinaires pour expliquer les produits.',
            ],
            [
                'name' => 'Administration and Staff', 
                'description' => 'Assurer la bonne gestion de l’entreprise sur le plan administratif et financier.
                Composition :
                Directeur général : Superviseur de toutes les équipes.
                Responsable RH : Gestion des membres et des recrutements.
                Responsable financier : Gestion des budgets et investissements.
                Activités :
                Planification stratégique.
                Gestion des contrats des riders et des employés.
                Recherche de financements ou investisseurs.',
            ],
        ];
        return $this->json($teams);
    }*/
}
