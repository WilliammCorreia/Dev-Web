<?php

require_once('./classe/Ennemi.php');

// Notre Chevalier Noir va avoir toutes les fonctions et attribut de la classe Ennemi
class DarkKnight extends Ennemi
{
    public function __construct()
    {
        $this->pol = 10; // pol = Point Of Life
        $this->name = "Chevalier Noir";
        $this->power = 15;
        $this->constitution = 15;
        $this->speed = 5;
        $this->xp = 20;
    }

    public function fear()
    {
        
    }
}