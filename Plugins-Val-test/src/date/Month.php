<?php

namespace app\date ;

class Month {
    public $days = ['Lundi', 'Mardi' , 'Mercredi' ,'Jeudi', 'Vendredi' ,'Samedi', 'Dimanche'] ;
    public $months = ['janvier', 'Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'];
    public $month ;
    public $year;
/**
 * Month contructor
 * @param $month le moi compris entre 1 et 12
 * @param $year l'année
 */
    public function __construct(int $month = null,int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12){
            $month = intval (date ('m'));
        }
        if ($year === null ){
            $year = intval (date ('Y'));
        }
        if( $month < 1 || $month > 12){
        
            throw new \Exception("le moi $month n'est pas valide");
        }
        
        $this->month= $month;
        $this->year=$year;
        
    }
    /**
     * Renvoie le premier jour du mois
     * @return DateTime
     */

    public function getStartingDay() : \DateTime {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    public function toString (): String {
    
     return $this->months[$this->month - 1] . ' ' . $this->year;

    }
    /**
     * renvoie le nombre de semaine dans le mois
     */
    public function getWeeks (): int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W')) +1;
        if ( $weeks < 0 ){
            $weeks = intval($end->format('W'));
        }
        return $weeks ;
    }
    /**
     * renvoie le mois suivant
     */
    public function withinMouth(\DateTime $date) : bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }
    public function nextMonth (): Month {

        $month = $this->month + 1; 
        $year = $this->year;
        if ($month > 12) {
            $month = 1 ;
            $year += 1 ;
        }
        return new Month($month, $year) ;
    }
    /**
     * renvoie le mois precedent
     */
    public function previousMonth (): Month {

        $month = $this->month - 1; 
        $year = $this->year;
        if ($month < 1) {
            $month = 12 ;
            $year -= 1 ;
        }
        return new Month($month, $year) ;
    }
}
?> 