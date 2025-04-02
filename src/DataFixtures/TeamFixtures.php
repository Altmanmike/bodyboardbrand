<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private TeamRepository $repo)
    {
    }

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        // Teams
        $team = new Team();
        $team->setName('Bodyboarders Pro');
        $team->setDescription('Représenter la marque dans les compétitions, les événements, et sur les réseaux sociaux. 
                    
                Composition :
                Leader de l\'équipe : Le rider principal, souvent le visage de la marque.
                Riders internationaux : Participants réguliers aux compétitions IBA et autres grands circuits.
                Riders locaux : Représentants régionaux pour promouvoir la marque dans des niches spécifiques (Antilles, Océan Indien, etc.).
                Ambassadeurs : Pas forcément compétiteurs, mais influents dans la communauté bodyboard (réseaux sociaux, surf shops, etc.).
                
                Activités :
                Compétitions nationales et internationales.
                Production de contenu (vidéos, photos).
                Sessions de test pour les nouveaux produits.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_0'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Bodyboarders Pro-Amateurs');
        $team->setDescription('Représenter la marque dans les compétitions, les événements, et sur les réseaux sociaux. 
                    
                Composition :
                Leader de l\'équipe : Le rider principal, souvent le visage de la marque.
                Riders internationaux : Participants réguliers aux compétitions IBA et autres grands circuits.
                Riders locaux : Représentants régionaux pour promouvoir la marque dans des niches spécifiques (Antilles, Océan Indien, etc.).
                Ambassadeurs : Pas forcément compétiteurs, mais influents dans la communauté bodyboard (réseaux sociaux, surf shops, etc.).
                
                Activités :
                Compétitions nationales et internationales.
                Production de contenu (vidéos, photos).
                Sessions de test pour les nouveaux produits.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_0'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Bodyboarders Juniors');
        $team->setDescription('Représenter la marque dans les compétitions, les événements, et sur les réseaux sociaux. 
                    
                Composition :
                Leader de l\'équipe : Le rider principal, souvent le visage de la marque.
                Riders internationaux : Participants réguliers aux compétitions IBA et autres grands circuits.
                Riders locaux : Représentants régionaux pour promouvoir la marque dans des niches spécifiques (Antilles, Océan Indien, etc.).
                Ambassadeurs : Pas forcément compétiteurs, mais influents dans la communauté bodyboard (réseaux sociaux, surf shops, etc.).
                
                Activités :
                Compétitions nationales et internationales.
                Production de contenu (vidéos, photos).
                Sessions de test pour les nouveaux produits.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_0'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Ingénieurs');
        $team->setDescription('Concevoir et améliorer les produits (planches, palmes, leash, etc.) en intégrant les retours des riders et les tendances du marché.
                
                Composition :
                Ingénieurs matériaux : Pour travailler sur les stingers, les noyaux, et les revêtements.
                Designers produit : Création des designs innovants (formes, graphismes).
                Testeurs techniques : Riders impliqués dans les phases de tests intensifs.
                Responsables CAO et simulation : Pour modéliser les équipements et simuler leur comportement sur des vagues.
                
                Activités :
                Prototypage et tests des produits.
                Innovation sur les formes et les matériaux.
                Analyse des impacts (A.R.S., Invert, etc.).
                Collaboration avec les riders pour améliorer les produits.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_1'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Développement web');
        $team->setDescription('Concevoir le site et ses fonctionnalités en intégrant les retours des utilisateurs.
                
                Composition :                
                Designers : Création des designs innovants (formes, graphismes).
                Web développeurs : Maintenance et développement de la plateforme (ReactJS, Symfony).
                Testeurs techniques : Utilisateurs impliqués dans les phases de tests intensifs.                
                
                Activités :
                Tests unitaires.
                Force de propositions
                Rédaction des spécificités et cahiers des charges.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_3'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Managers');
        $team->setDescription('Assurer la visibilité et la promotion de la marque auprès des communautés locales et internationales.
                
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
                Suivi des tendances de la communauté bodyboard.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_2'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Responsables');
        $team->setDescription('Gérer les ventes en ligne et maximiser les revenus.
                
                Composition :
                Responsable RH : Gestion des membres et des recrutements.
                Responsable financier : Gestion des budgets et investissements.
                Responsable e-commerce : Supervision de la boutique en ligne.                
                Logistique : Gestion des stocks, préparation des commandes.
                Analystes de données : Suivi des ventes et des retours clients.
                                
                Activités :
                Planification stratégique.
                Gestion des contrats des riders et des employés.
                Recherche de financements ou investisseurs.
                Gestion du site e-commerce (SEO, UX).
                Lancement de nouvelles collections et promotions.
                Optimisation des process logistiques.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_3'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Techniciens');
        $team->setDescription('Offrir un support client de qualité et traiter les demandes des clients et partenaires.
                
                Composition :
                Responsables support : Traitement des tickets clients (retours, réparations, etc.).
                Techniciens produits : Pour les réparations et conseils techniques.
                Ambassadeurs service : Riders ou experts disponibles pour des tutoriels en ligne ou des FAQ.
                
                Activités :
                Suivi des commandes et réclamations.
                Conseils personnalisés pour les clients.
                Organisation d\'ateliers et webinaires pour expliquer les produits.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_4'));
        $manager->persist($team);

        $team = new Team();
        $team->setName('Direction');
        $team->setDescription('Assurer la bonne gestion de l’entreprise sur le plan administratif et financier.
                
                Composition :
                Directeur général : Superviseur de toutes les équipes.                
                Responsable RH : Gestion des membres et des recrutements.
                Responsable financier : Gestion des budgets et investissements.

                Activités :
                Planification stratégique.
                Gestion des contrats des riders et des employés.
                Recherche de financements ou investisseurs.');
        $team->setCreatedAt(new \DateTimeImmutable());
        $team->setUpdatedAt(new \DateTimeImmutable());
        $team->setCategory($this->getReference('categoryTeam_5'));
        $manager->persist($team);

        $manager->flush();
    }

    #[\Override]
    public function getDependencies(): array
    {
        return [
            CategoryTeamFixtures::class,
        ];
    }
}
