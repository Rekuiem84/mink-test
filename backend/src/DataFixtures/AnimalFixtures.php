<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Type;
use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    // Créer les types d'animaux
    $typesData = [
      'Chien',
      'Cheval',
      'Brebis',
      'Cochon'
    ];

    foreach ($typesData as $typeName) {
      $type = new Type();
      $type->setName($typeName);
      $manager->persist($type);
    }

    // Créer les races d'animaux
    $breedsData = [
      'Labrador',
      'Border Collie',
      'Pottok',
      'Frison',
      'Irish Cob',
      'Mérinos',
      'Solognotes',
      'Large White',
      'Landrace',
    ];

    foreach ($breedsData as $breedName) {
      $breed = new Breed();
      $breed->setName($breedName);
      $manager->persist($breed);
    }

    $manager->flush();

    // Récupérer les types et races créés
    $typeChien = $manager->getRepository(Type::class)->findOneBy(['name' => 'Chien']);
    $typeCheval = $manager->getRepository(Type::class)->findOneBy(['name' => 'Cheval']);
    $typeBrebis = $manager->getRepository(Type::class)->findOneBy(['name' => 'Brebis']);
    $typeCochon = $manager->getRepository(Type::class)->findOneBy(['name' => 'Cochon']);

    $raceLabrador = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Labrador']);
    $raceBorderCollie = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Border Collie']);
    $racePottok = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Pottok']);
    $raceFrison = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Frison']);
    $raceIrishCob = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Irish Cob']);
    $raceMerinos = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Mérinos']);
    $raceSolognotes = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Solognotes']);
    $raceLargeWhite = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Large White']);
    $raceLandrace = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Landrace']);

    // Créer 8 chiens
    $chiensData = [
      ['name' => 'Udo', 'age' => 2, 'price' => 999.99, 'description' => 'Labrador énergique et affectueux, parfait pour une famille.', 'breed' => $raceLabrador],
      ['name' => 'Alpha', 'age' => 2, 'price' => 920.00, 'description' => 'Border Collie intelligent et obéissant, excellent chien de berger.', 'breed' => $raceBorderCollie],
      ['name' => 'Bravo', 'age' => 4, 'price' => 780.00, 'description' => 'Labrador calme et patient, idéal avec les enfants.', 'breed' => $raceLabrador],
      ['name' => 'Charlie', 'age' => 1, 'price' => 950.00, 'description' => 'Jeune Border Collie pleine d\'énergie et très joueuse.', 'breed' => $raceBorderCollie],
      ['name' => 'Delta', 'age' => 5, 'price' => 720.00, 'description' => 'Labrador expérimenté, parfait chien de compagnie.', 'breed' => $raceLabrador],
      ['name' => 'Echo', 'age' => 2, 'price' => 890.00, 'description' => 'Border Collie douce et intelligente, facile à dresser.', 'breed' => $raceBorderCollie],
      ['name' => 'Foxtrot', 'age' => 3, 'price' => 810.00, 'description' => 'Labrador robuste et fidèle, excellent gardien.', 'breed' => $raceLabrador],
    ];

    foreach ($chiensData as $chienData) {
      $chien = new Animal();
      $chien->setName($chienData['name']);
      $chien->setAge($chienData['age']);
      $chien->setPrice($chienData['price']);
      $chien->setDescription($chienData['description']);
      $chien->setIsAvailable(rand(0, 1) === 1);
      $chien->setType($typeChien);
      $chien->setBreed($chienData['breed']);
      $manager->persist($chien);
    }

    // Créer 8 chevaux
    $chevauxData = [
      ['name' => 'Thunder', 'age' => 8, 'price' => 3500.00, 'description' => 'Pottok robuste et endurant, parfait pour la randonnée.', 'breed' => $racePottok],
      ['name' => 'Storm', 'age' => 6, 'price' => 4200.00, 'description' => 'Frison élégant et puissant, idéal pour le dressage.', 'breed' => $raceFrison],
      ['name' => 'Spirit', 'age' => 4, 'price' => 2800.00, 'description' => 'Irish Cob polyvalent et docile, bon pour débutants.', 'breed' => $raceIrishCob],
      ['name' => 'Midnight', 'age' => 7, 'price' => 4500.00, 'description' => 'Frison noir magnifique, excellent en spectacle.', 'breed' => $raceFrison],
      ['name' => 'Rusty', 'age' => 5, 'price' => 3200.00, 'description' => 'Pottok alezan, très gentil et facile à monter.', 'breed' => $racePottok],
      ['name' => 'Duchess', 'age' => 6, 'price' => 3800.00, 'description' => 'Irish Cob pie, calme et sûre pour tous niveaux.', 'breed' => $raceIrishCob],
      ['name' => 'Apollo', 'age' => 9, 'price' => 4800.00, 'description' => 'Frison expérimenté, maître de dressage classique.', 'breed' => $raceFrison],
    ];

    foreach ($chevauxData as $chevalData) {
      $cheval = new Animal();
      $cheval->setName($chevalData['name']);
      $cheval->setAge($chevalData['age']);
      $cheval->setPrice($chevalData['price']);
      $cheval->setDescription($chevalData['description']);
      $cheval->setIsAvailable(rand(0, 1) === 1);
      $cheval->setType($typeCheval);
      $cheval->setBreed($chevalData['breed']);
      $manager->persist($cheval);
    }

    // Créer 8 brebis
    $brebisData = [
      ['name' => 'Dolly', 'age' => 2, 'price' => 450.00, 'description' => 'Mérinos de qualité, excellente productrice de laine.', 'breed' => $raceMerinos],
      ['name' => 'Woolly', 'age' => 3, 'price' => 520.00, 'description' => 'Solognotes rustique, parfaite pour l\'écopâturage.', 'breed' => $raceSolognotes],
      ['name' => 'Fluffy', 'age' => 1, 'price' => 380.00, 'description' => 'Jeune Mérinos aux belles boucles de laine.', 'breed' => $raceMerinos],
      ['name' => 'Pepper', 'age' => 4, 'price' => 580.00, 'description' => 'Solognotes expérimentée, mère prolificque.', 'breed' => $raceSolognotes],
      ['name' => 'Cloud', 'age' => 2, 'price' => 480.00, 'description' => 'Mérinos douce et docile, facile à manipuler.', 'breed' => $raceMerinos],
      ['name' => 'Sage', 'age' => 3, 'price' => 550.00, 'description' => 'Solognotes robuste, adaptée aux terrains difficiles.', 'breed' => $raceSolognotes],
    ];

    foreach ($brebisData as $brebisDataItem) {
      $brebis = new Animal();
      $brebis->setName($brebisDataItem['name']);
      $brebis->setAge($brebisDataItem['age']);
      $brebis->setPrice($brebisDataItem['price']);
      $brebis->setDescription($brebisDataItem['description']);
      $brebis->setIsAvailable(rand(0, 1) === 1);
      $brebis->setType($typeBrebis);
      $brebis->setBreed($brebisDataItem['breed']);
      $manager->persist($brebis);
    }

    // Créer 8 cochons
    $cochonsData = [
      ['name' => 'Bacon', 'age' => 1, 'price' => 320.00, 'description' => 'Large White de qualité, croissance rapide.', 'breed' => $raceLargeWhite],
      ['name' => 'Hamlet', 'age' => 2, 'price' => 380.00, 'description' => 'Landrace danois, excellent pour la reproduction.', 'breed' => $raceLandrace],
      ['name' => 'Porky', 'age' => 1, 'price' => 340.00, 'description' => 'Large White robuste, très bon rendement.', 'breed' => $raceLargeWhite],
      ['name' => 'Truffle', 'age' => 3, 'price' => 450.00, 'description' => 'Landrace mature, reproductrice expérimentée.', 'breed' => $raceLandrace],
      ['name' => 'Babe', 'age' => 1, 'price' => 310.00, 'description' => 'Jeune Large White pleine de vivacité.', 'breed' => $raceLargeWhite],
      ['name' => 'Pickles', 'age' => 2, 'price' => 390.00, 'description' => 'Landrace calme et docile, facile à élever.', 'breed' => $raceLandrace],
    ];

    foreach ($cochonsData as $cochonData) {
      $cochon = new Animal();
      $cochon->setName($cochonData['name']);
      $cochon->setAge($cochonData['age']);
      $cochon->setPrice($cochonData['price']);
      $cochon->setDescription($cochonData['description']);
      $cochon->setIsAvailable(rand(0, 1) === 1);
      $cochon->setType($typeCochon);
      $cochon->setBreed($cochonData['breed']);
      $manager->persist($cochon);
    }

    $manager->flush();
  }
}
