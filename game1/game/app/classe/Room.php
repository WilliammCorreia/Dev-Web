<?php

class Room {
    private string $name;
    private string $description;
    private string $type;
    private string $donjon_id;

    public function __construct($room)
    {
        $this->name = $room['name'];
        $this->description = $room['description'];
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function setDescription(string $description):void
    {
        $this->description = $description;
    }

    public function getAction():string
    {
        return 'Actions';
    }

    public function getAction():string 
    {
        $html = "";

        switch($this->$type){
            case 'vide':
                $html .= "<a href='donjon_play.php?id=". $this->donjon_id ."'>Continuer l'exploration</a>";
                break;

            case 'treasur':
                $or = rand(0,20);
                $_SESSION['perso']['gold'] += $or;

                $html .= "<p>Vous avez gagné ". $or ." pièce d'or<p>";
                $html .= "<a href='donjon_play.php?id=". $this->donjon_id ."'> Continuer l'exploration";
                break;
            
            default;
                $html .= "Aucune action possible !";
                break;
        }

        return $html;
    }
}