<?php

namespace App\DataFixtures;

use App\Entity\Annee;
use App\Entity\Departement;
use App\Entity\Description;
use App\Entity\Diplome;
use App\Entity\Ecole;
use App\Entity\Mention;
use App\Entity\Module;
use App\Entity\Parcours;
use App\Entity\Pole;
use App\Entity\Semestre;
use App\Entity\UE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CursusFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($nbEcole=0; $nbEcole <1; $nbEcole++){

            $ecole = new Ecole();
            $ecole->setNom($faker->realText(50));
            $manager->persist($ecole);

            for ($nbDepartement = 0; $nbDepartement < random_int(2,3); $nbDepartement++){

                $departement = new Departement();
                $departement->setNom($faker->realText(50))
                    ->setEcole($ecole);
                $manager->persist($departement);

                for ($nbPole = 0; $nbPole < random_int(2,3); $nbPole++){

                    $pole = new Pole();
                    $pole->setNom($faker->realText(50))
                        ->setDepartement($departement);
                    $manager->persist($pole);

                    $listDiplome = array();

                    $licence = new Diplome();
                    $licence->setNom("licence")
                        ->setNbAnnee(3)
                        ->setNiveauDiplome("Bac +3")
                        ->setPole($pole);
                    $manager->persist($licence);
                    array_push($listDiplome,$licence);

                    $master = new Diplome();
                    $master->setNom("master")
                        ->setNbAnnee(2)
                        ->setNiveauDiplome("Bac +5")
                        ->setPole($pole);
                    $manager->persist($master);
                    array_push($listDiplome, $master);

                    foreach ($listDiplome as $diplome){

                        for ($nbAnnee = 1; $nbAnnee < $diplome->getNbAnnee()+1; $nbAnnee++) {
                            $annee = new Annee();
                            if ($diplome->getNom() == "licence") {
                                $annee->setNom("L" . $nbAnnee);
                                $licence->addAnnee($annee);
                            }elseif ($diplome->getNom() == "master"){
                                $annee->setNom("M".$nbAnnee);
                                $master->addAnnee($annee);
                            }
                            $annee->setNumeroAnnee($nbAnnee);
                            $manager->persist($annee);
                        }

                            for ($nbMention = 0; $nbMention < random_int(3,5); $nbMention++) {

                            $mention = new Mention();
                            $mention->setNom($faker->realText(50))
                                ->setDiplome($diplome);
                            $manager->persist($mention);

                            for ($nbParcours = 0; $nbParcours < random_int(1,3); $nbParcours++) {

                                $parcours = new Parcours();
                                $description = new Description();
                                $description->setAtouts($faker->text())
                                    ->setCompetences($faker->text())
                                    ->setContact($faker->text())
                                    ->setDeboucherPro($faker->text())
                                    ->setDescriptionBref($faker->text())
                                    ->setFichePDF($faker->text())
                                    ->setModaliteInscription($faker->text())
                                    ->setPoursuiteEtude($faker->text())
                                    ->setPreRequis($faker->text())
                                    ->setPublicConcerne($faker->text())
                                    ->setTarif($faker->text());
                                $manager->persist($description);

                                if ($nbParcours == 0){
                                    $parcours->setNom("default");
                                }else{
                                    $parcours->setNom($faker->realText(50));
                                }
                                $parcours->setMention($mention)
                                    ->setDescription($description);
                                $manager->persist($parcours);

                                foreach ($diplome->getAnnees() as $annee){

                                    for ($nbSemestre = 0; $nbSemestre < 2; $nbSemestre++){

                                        $semestre = new Semestre();
                                        $semestre->setNom($faker->realText(50))
                                            ->setAnnee($annee)
                                            ->setParcours($parcours);
                                        $manager->persist($semestre);

                                        for ($nbUE = 0; $nbUE < random_int(5,10); $nbUE++){

                                            $ue = new UE();
                                            $ue->setNom($faker->realText(50))
                                                ->setSemestre($semestre);
                                            $manager->persist($ue);

                                            for ($nbModule = 0; $nbModule < random_int(1,3); $nbModule++){

                                                $module = new Module();
                                                $module->setNom($faker->realText(50))
                                                    ->setAsObligatoire(random_int(0,1))
                                                    ->setECTS(random_int(1,5))
                                                    ->setCoef(random_int(1,3))
                                                    ->setUE($ue);
                                                $manager->persist($module);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $manager->flush();
    }
}
