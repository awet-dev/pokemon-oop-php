<?php


class Pokemon
{
    private string $name;
    private int $id;
    private string $imgSrc;
    private array $pokeData;
    private array $evolutionChain = [];

    public function getPokemon($pokemon) {
        $api_url = 'https://pokeapi.co/api/v2/pokemon/'.$pokemon;
        if(FALSE !== ($content = @file_get_contents($api_url))) {
            $this->pokeData = $this->fetch($api_url);
        }
        else {
            die("This name doesn't exist!");
        }



        // set the variables
        $this->name = $this->pokeData['name'];
        $this->id = $this->pokeData['id'];
        $this->imgSrc = $this->pokeData['sprites']['front_shiny'];
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function getImgSrc () {
        return $this->imgSrc;
    }

//    public function getData() {
//        return $this->pokeData;
//    }

    public function getMoves ($num, $arrayMoves = []) {
        foreach ($this->pokeData['moves'] as $move) {
            array_push($arrayMoves, $move['move']['name']);
        }
        return array_slice($arrayMoves, 0, $num);
    }

    private function fetch($url) {
        $data = file_get_contents($url);
        $decoded_data = json_decode($data);
        return json_decode(json_encode($decoded_data), true);
    }

    public function fetchEvolution () {
        $species = $this->fetch($this->pokeData['species']['url']);
        $evolutionUrl = $species['evolution_chain']['url'];
        $evolution = $this->fetch($evolutionUrl)['chain'];
        while ($evolution['evolves_to']) {
            array_push($this->evolutionChain, $evolution['species']['name']);
            $evolution = $evolution['evolves_to'][0];
        }
        array_push($this->evolutionChain, $evolution['species']['name']);
        return $this->evolutionChain;
    }

    public function evolution($array = []) {
        $species = $this->fetch($this->pokeData['species']['url']);
        $evolutionUrl = $species['evolution_chain']['url'];
        $evolution = $this->fetch($evolutionUrl)['chain'];
        foreach ($evolution['evolves_to'] as $evolution) {
            array_push($array, $evolution['species']['name']);
        }
        return $array;
    }

    public function flavorTextEntries($flavor_text = []) {
        $species = $this->fetch($this->pokeData['species']['url']);
        $random_flavor_text = $species['flavor_text_entries'][rand(0, count($species['flavor_text_entries']))];
        $flavor_text = array('flavor_text' => $random_flavor_text['flavor_text'], 'language' => $random_flavor_text['language']['name']);
        return $flavor_text;
    }

    public function setImgEvolution($imgSrc = []) {
        $evoName = $this->fetchEvolution();
        foreach ($evoName as $name) {
            $this->getPokemon($name);
            array_push($imgSrc, $this->getImgSrc());
        }
        return $imgSrc;
    }

}