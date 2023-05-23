<?php

require_once('./classe/Ennemi.php');

// Notre Chevalier Noir va avoir toutes les fonctions et attribut de la classe Ennemi
class GhostKing extends Ennemi
{
    public function __construct()
    {
        $this->pol = 100; // pol = Point Of Life
        $this->name = "Fantôme des Damnés";
        $this->power = 30;
        $this->constitution = 15;
        $this->speed = 10;
        $this->xp = 75;
        $this->gold = 150;
    }

    public function fear()
    {
        
    }
}