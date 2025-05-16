<?php

class PublicationContr extends PublicationModel {
    private $id;

    // Attributes related to search
    private $searchQuery;
    private $filter;

    // Attributes related to publication
    private $reference;
    private $titre;
    private $auteurs;
    private $soumisPar;
    private $lieu;
    private $doi;
    private $date;
    private $type;
    private $numero;
    private $volume;
    private $publication;
    private $attestation;
    private $rapport;
    private $thesard_id;

    // Constructor "overloading"
    public function __construct(...$args) {
        echo count($args);
        if (count($args) === 1) {
            echo "one";
            $this->handleOneParameter($args[0]);
        } elseif (count($args) === 2) {
            echo "two";
            $this->handleTwoParameter($args[0], $args[1]);
        } elseif (count($args) === 14) {
            echo "13";
            $this->handleFourteenParameter(
                $args[0],
                $args[1],
                $args[2],
                $args[3],
                $args[4],
                $args[5],
                $args[6],
                $args[7],
                $args[8],
                $args[9],
                $args[10],
                $args[11],
                $args[12],
                $args[13],
            );
        } else {
            throw new InvalidArgumentException('Invalid number of arguments passed to constructor');
        }
    }

    private function handleOneParameter($id) {
        $this->id = $id;
    }

    private function handleTwoParameter($searchQuery, $filter) {
        $this->searchQuery = $searchQuery;
        $this->filter = $filter;
    }

    private function handleFourteenParameter(
        $reference,
        $titre,
        $auteurs,
        $soumisPar,
        $lieu,
        $doi,
        $date,
        $type,
        $numero,
        $volume,
        $publication,
        $attestation,
        $rapport,
        $thesard_id
    ) {
        $this->reference = $reference;
        $this->titre = $titre;
        $this->auteurs = $auteurs;
        $this->soumisPar = $soumisPar;
        $this->lieu = $lieu;
        $this->doi = $doi;
        $this->date = $date;
        $this->type = $type;
        $this->numero = $numero;
        $this->volume = $volume;
        $this->publication = $publication;
        $this->attestation = $attestation;
        $this->rapport = $rapport;
        $this->thesard_id = $thesard_id;
    }

    public function delete() {
        $this->deletePublication($this->id);
    }

    public function search() {
        $results = $this->getPublicationsByFilter($this->searchQuery, $this->filter);

        // Send results back to index
        header("Location: publications.php?results=" . urlencode(serialize($results)));
        exit();
    }

    public function add() {
        if ($this->isEmptyInput()) {
            header("location: publications.php?error=emptyInput");
            exit();
        }

        if ($this->isNotPDF()) {
            header("location: publications.php?error=notPDF");
            exit();
        }

        // Create directories where to store PDFs
        $directories = [
            "uploads/publications",
            "uploads/attestations",
            "uploads/rapports"
        ];
        
        foreach ($directories as $dir) {
            if (!file_exists(__DIR__ . "/../../../" . $dir)) {
                mkdir(__DIR__ . "/../../../" . $dir, 0755, true);
                echo "Created: $dir<br>";
            }
        }

        $this->setPublication(
            $this->reference,
            $this->titre,
            $this->auteurs,
            $this->soumisPar,
            $this->lieu,
            $this->doi,
            $this->date,
            $this->type,
            $this->numero,
            $this->volume,
            $this->publication["name"],
            $this->attestation["name"],
            $this->rapport["name"],
            $this->thesard_id
        );

        move_uploaded_file(
            $this->publication["tmp_name"],
            __DIR__ . "/../../../uploads/publications/" . $this->publication["name"]
        );
        move_uploaded_file(
            $this->attestation["tmp_name"],
            __DIR__ . "/../../../uploads/attestations/" . $this->attestation["name"]
        );
        move_uploaded_file(
            $this->rapport["tmp_name"],
            __DIR__ . "/../../../uploads/rapports/" . $this->rapport["name"]
        );
    }

    private function isEmptyInput() {
        return (
            empty($this->reference) ||
            empty($this->titre) ||
            empty($this->auteurs) ||
            empty($this->lieu) ||
            empty($this->doi) ||
            empty($this->date) ||
            empty($this->type) ||
            empty($this->publication) ||
            empty($this->attestation) ||
            empty($this->rapport) ||
            empty($this->thesard_id)
        );
    }

    private function isNotPDF() {
        return (
            $this->publication["type"] !== "application/pdf" ||
            $this->attestation["type"] !== "application/pdf" ||
            $this->rapport["type"] !== "application/pdf"
        );
    }
}
