<?php

namespace App\Votee\Model\DataObject;

class Proposition extends AbstractDataObject {

    private int $idProposition;
    private int $idQuestion;
    private int $visibilite;

    public function __construct(int $idProposition, int $idQuestion, int $visibilite) {
        $this->idProposition = $idProposition;
        $this->idQuestion = $idQuestion;
        $this->visibilite = $visibilite;
    }

    public function formatTableau(): array {
        return array(
            "IDPROPOSITION" => $this->getIdProposition(),
            "IDQUESTION" => $this->getIdQuestion(),
            "VISIBILITE" => $this->getVisibilite(),
        );
    }

    public function getVisibilite(): int { return $this->visibilite; }

    public function setVisibilite(int $visibilite): void { $this->visibilite = $visibilite; }

    public function getIdProposition(): int { return $this->idProposition; }

    public function setIdProposition(int $idProposition): void { $this->idProposition = $idProposition; }

    public function getIdQuestion(): int { return $this->idQuestion; }

    public function setIdQuestion(int $idQuestion): void { $this->idQuestion = $idQuestion; }

}