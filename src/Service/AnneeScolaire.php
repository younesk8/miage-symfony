<?php


namespace App\Service;


use DateTime;
use phpDocumentor\Reflection\Types\Integer;

class AnneeScolaire
{
    private const JOURDEBUTANNEE = 1;
    private const MOISBEDUTANNEE = 9;
    /**
     * @param String $anneeScolaire
     * @return array
     */
    private function goToNumber(String $anneeScolaire) : array{
        return array(intval(substr($anneeScolaire,0,3)), intval(substr($anneeScolaire,5)));
    }

    /**
     * @param array $anneeInt
     * @return String
     */
    private function goToString(array $anneeInt) : String{
        return $anneeInt[0] . "-" . $anneeInt[1];
    }

    /**
     * @param String $anneeScolaire
     * @param Integer $nbAdd
     * @return String
     */
    public function add(String $anneeScolaire, Integer $nbAdd) : String{
        $anneeInt = $this->goToNumber($anneeScolaire);
        $anneeInt[0] += $nbAdd;
        $anneeInt[1] += $nbAdd;
        return $this->goToString($anneeInt);
    }

    /**
     * @return String
     */
    public function anneeEnCours() : String{
        $jour = intval(date("j"));
        $mois = intval(date("n"));
        $annee = intval(date("Y"));
        if ($mois > self::MOISBEDUTANNEE || ($mois == self::MOISBEDUTANNEE && $jour >= self::JOURDEBUTANNEE) ){
            return $this->goToString(array($annee, $annee+1));
        }else{
            return $this->goToString(array($annee-1, $annee));
        }
    }

    /**
     * @param DateTime $dateTime
     * @return String
     */
    public function dateToAnneScolaire(DateTime $dateTime) : String{
        $jour = intval($dateTime->format("j"));
        $mois = intval($dateTime->format("n"));
        $annee = intval($dateTime->format("Y"));
        if ($mois > self::MOISBEDUTANNEE || ($mois == self::MOISBEDUTANNEE && $jour >= self::JOURDEBUTANNEE) ){
            return $this->goToString(array($annee, $annee+1));
        }else{
            return $this->goToString(array($annee-1, $annee));
        }
    }
}
