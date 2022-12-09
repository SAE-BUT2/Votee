<?php

namespace App\Votee\Model\Repository;

use App\Votee\Model\DataObject\Commentaire;
use PDOException;

class CommentaireRepository extends AbstractRepository {

    protected function getNomsColonnes(): array {
        return array(
            'IDCOMMENTAIRE',
            'NUMEROPARAGRAPHE',
            'INDEXCHARDEBUT',
            'INDEXCHARFIN',
            'TEXTECOMMENTAIRE'
        );

    }
    function getNomTable(): string {
        return "Commentaires";
    }

    function getNomClePrimaire(): string {
        return "IDCOMMENTAIRE";
    }

    function getProcedureInsert(): string { return ""; }

    function getProcedureUpdate(): string { return "ModifierCommentaires"; }

    function getProcedureDelete(): string { return "SupprimerCommentaires"; }

    public function construire(array $propositionFormatTableau) : Commentaire {
        return new Commentaire(
            $propositionFormatTableau['IDCOMMENTAIRE'],
            $propositionFormatTableau['NUMEROPARAGRAPHE'],
            $propositionFormatTableau['INDEXCHARDEBUT'],
            $propositionFormatTableau['INDEXCHARFIN'],
            $propositionFormatTableau['TEXTECOMMENTAIRE']
        );
    }

    public function ajouterCommentaireEtStocker($idQuestion, $idProposition, $numeroParagraphe, $indexCharDebut, $indexCharFin, $texteCommentaire): bool {
        $sql = "CALL AjouterCommentairesEtStocker(:idQuestion, :idProposition, :numeroParagraphe, :indexCharDebut, :indexCharFin, :texteCommentaire)";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "idQuestion" => $idQuestion,
            "idProposition" => $idProposition,
            "numeroParagraphe" => $numeroParagraphe,
            "indexCharDebut" => $indexCharDebut,
            "indexCharFin" => $indexCharFin,
            "texteCommentaire" => $texteCommentaire
        );
        try {
            $pdoStatement->execute($values);
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function supprimerCommentaireSiSectionModifier($idProposition, $numeroParagraphe) : bool {
        $sql = "SELECT c.idCommentaire FROM Stocker s JOIN Commentaires c ON s.idCommentaire = c.idCommentaire WHERE idProposition = :idProposition AND numeroParagraphe = :numeroParagraphe";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "idProposition" => $idProposition,
            "numeroParagraphe" => $numeroParagraphe
        );
        try {
            $pdoStatement->execute($values);
            $resultat = $pdoStatement->fetchAll();
            foreach ($resultat as $idCommentaire)
                $this->supprimer(intval($idCommentaire[0]));
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function getCommentaireById($idProposition) {
        $sql = "SELECT IDQUESTION, IDPROPOSITION, s.IDCOMMENTAIRE, NUMEROPARAGRAPHE, INDEXCHARDEBUT, INDEXCHARFIN, TEXTECOMMENTAIRE FROM Stocker s JOIN Commentaires c ON s.idCommentaire = c.idCommentaire WHERE IDPROPOSITION = :idProposition";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "idProposition" => $idProposition
        );
        try {
            $pdoStatement->execute($values);
            $result = $pdoStatement->fetch();
            return $this->construire($result);
        } catch (PDOException) {
            return null;
        }
    }

}