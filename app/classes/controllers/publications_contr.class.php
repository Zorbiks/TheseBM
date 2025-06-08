<?php

class PublicationContr extends PublicationModel {
    // ID of the publication (used in deletion or modification)
    private $id;

    // Attributes related to search
    private $searchQuery;
    private $filter;

    // Attributes related to publication
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

    // Constructor "overloading" using argument count
    public function __construct(...$args) {
        if (count($args) === 1) {
            $this->handleOneParameter($args[0]);
        } elseif (count($args) === 2) {
            $this->handleTwoParameter($args[0], $args[1]);
        } elseif (count($args) === 3) {
            $this->handleThreeParameter($args[0], $args[1], $args[2]);
        } elseif (count($args) === 12) {
            $this->handleTwelveParameter(
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
                $args[11]
            );
        } elseif (count($args) === 13) {
            $this->handleThirteenParameter(
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
                $args[12]
            );
        } else {
            throw new InvalidArgumentException('Invalid number of arguments passed to constructor');
        }
    }

    // Used for deleting a publication
    private function handleOneParameter($id) {
        $this->id = $id;
    }

    // Used when the user searching is a professor
    private function handleTwoParameter($searchQuery, $filter) {
        $this->searchQuery = $searchQuery;
        $this->filter = $filter;
    }

    // Used when the user searching is a thesard
    private function handleThreeParameter($searchQuery, $filter, $thesard_id) {
        $this->searchQuery = $searchQuery;
        $this->filter = $filter;
        $this->thesard_id = $thesard_id;
    }

    // Used when modifying an existing publication
    private function handleTwelveParameter(
        $id,
        $titre,
        $auteurs,
        $lieu,
        $doi,
        $date,
        $type,
        $numero,
        $volume,
        $publication,
        $attestation,
        $rapport
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteurs = $auteurs;
        $this->lieu = $lieu;
        $this->doi = $doi;
        $this->date = $date;
        $this->type = $type;
        $this->numero = $numero;
        $this->volume = $volume;
        $this->publication = $publication;
        $this->attestation = $attestation;
        $this->rapport = $rapport;
    }

    // Used when adding a new publication
    private function handleThirteenParameter(
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

    // Delete a publication
    public function delete() {
        $this->deletePublication($this->id);
    }

    // Search for publications
    public function search() {
        $results = "";
        if (empty($this->thesard_id)) {
            $results = $this->getPublicationsByFilter($this->searchQuery, $this->filter);
        } else {
            $results = $this->getPublicationsByFilterAndThesardId($this->searchQuery, $this->filter, $this->thesard_id);
        }

        // Send results back to index
        header("Location: publications.php?results=" . urlencode(serialize($results)));
        exit();
    }

    // Add a new publication
    public function add() {
        // Validate input
        if ($this->isEmptyInputWhenAdding()) {
            header("location: publications.php?error=emptyInput");
            exit();
        }

        // Ensure files are PDF
        if ($this->isNotPDF()) {
            header("location: publications.php?error=notPDF");
            exit();
        }

        // Ensure required directories exist
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

        // Save publication to DB
        $this->setPublication(
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

        // Move uploaded PDF files to appropriate directories
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

    // Get publication title by ID
    public function getPublicationTitle($publication_id) {
        return $this->getPublicationTitleById($publication_id);
    }

    // Check if required fields are empty during add
    private function isEmptyInputWhenAdding() {
        return (
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

    // Check if required fields are empty during modification
    private function isEmptyInputWhenModify() {
        return (
            empty($this->titre) ||
            empty($this->auteurs) ||
            empty($this->lieu) ||
            empty($this->doi) ||
            empty($this->date) ||
            empty($this->type)
        );
    }

    // Modify an existing publication
    public function modify() {
        if ($this->isEmptyInputWhenModify()) {
            header("location: publications.php?error=emptyInput");
            exit();
        }

        // Update record in DB
        $this->updatePublication(
            $this->id,
            $this->titre,
            $this->auteurs,
            $this->lieu,
            $this->doi,
            $this->date,
            $this->type,
            $this->numero,
            $this->volume,
            $this->publication,
            $this->attestation,
            $this->rapport
        );

        // Replace uploaded files if new ones were provided
        if ($this->publication["error"] !== UPLOAD_ERR_NO_FILE) {
            move_uploaded_file(
                $this->publication["tmp_name"],
                __DIR__ . "/../../../uploads/publications/" . $this->publication["name"]
            );
        }
        
        if ($this->attestation["error"] !== UPLOAD_ERR_NO_FILE) {
            move_uploaded_file(
                $this->attestation["tmp_name"],
                __DIR__ . "/../../../uploads/attestations/" . $this->attestation["name"]
            );
        }

        if ($this->rapport["error"] !== UPLOAD_ERR_NO_FILE) {
            move_uploaded_file(
                $this->rapport["tmp_name"],
                __DIR__ . "/../../../uploads/rapports/" . $this->rapport["name"]
            );
        }
    }

    // Check if any uploaded file is not a PDF
    private function isNotPDF() {
        return (
            $this->publication["type"] !== "application/pdf" ||
            $this->attestation["type"] !== "application/pdf" ||
            $this->rapport["type"] !== "application/pdf"
        );
    }
}
