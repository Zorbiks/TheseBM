<?php

class DashboardView extends DashboardModel {
    public function renderPublicationStats() {
        $publicationsCounts = $this->getPublicationStats();

?>
        <div class="col-md-6 col-lg-3 border-end border-3">
            <div class="fw-bold fs-5">Publications</div>
            <div class="fw-bold fs-5"><?= $publicationsCounts["total"] ?></div>
        </div>
        <div class="col-md-6 col-lg-3 border-end border-3">
            <div class="fw-bold fs-5">Communications</div>
            <div class="fw-bold fs-5"><?= $publicationsCounts["communication"] ?></div>
        </div>
        <div class="col-md-6 col-lg-3 border-end border-3">
            <div class="fw-bold fs-5">Conférences</div>
            <div class="fw-bold fs-5"><?= $publicationsCounts["conference"] ?></div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="fw-bold fs-5">Chapitres</div>
            <div class="fw-bold fs-5"><?= $publicationsCounts["chapitre"] ?></div>
        </div>
<?php
    }

    public function renderThesardStats() {
        $thesardCounts = $this->getNumberOfThesards();
?>
        <div class="col-md-6">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="fw-bold fs-5">Thésards</div>
                    <div class="fw-bold fs-5"><?= $thesardCounts["active"] ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="fw-bold fs-5">Demandes d'inscription</div>
                    <div class="fw-bold fs-5"><?= $thesardCounts["inactive"] ?></div>
                </div>
            </div>
        </div>
<?php
    }
}