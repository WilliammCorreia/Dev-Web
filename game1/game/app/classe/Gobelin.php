<?php

require_once('./classe/Ennemi.php');

// Notre Gobelin va avoir toutes les fonctions et attribut de la classe Ennemi
class Gobelin extends Ennemi
{
    public function __construct()
    {
        $this->pol = 3; // pol = Point Of Life
        $this->name = "Gobelin";
        $this->power = 10;
        $this->constitution = 8;
        $this->speed = 7;
        $this->xp = 4;
        $this->gold = 10;
    }

    public function runaway()
    {
        
    }
}   