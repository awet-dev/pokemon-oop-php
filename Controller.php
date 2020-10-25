<?php


class Controller
{

    public function display() :void {

        $pokemon = new Pokemon();

        if (!empty($_POST['pokemon'])) {
            $pokemon->getPokemon($_POST['pokemon']);
            $name = $pokemon->getName();
            $id = $pokemon->getId();
            $imgSrc = $pokemon->getImgSrc();
            $moves = implode(", ", $pokemon->getMoves(4));
            $flavorText = $pokemon->flavorTextEntries()['flavor_text'];
            $flavorLanguage = $pokemon->flavorTextEntries()['language'];
            $evolutionImg = $pokemon->setImgEvolution();
        }
        require 'homepage.php';
    }
}