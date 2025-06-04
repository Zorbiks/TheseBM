<?php

class ThesardView extends ThesardsModel {
    // Render table of all thésards with their publication count and action links
    public function renderThesardsTable() {
        $thesards = $this->getAllThesards();

        // Display a message if there are no thesard
        if (count($thesards) === 0): ?>
            <p>Il n'y a pas de thésards sur la plateforme.</p>
        <?php else: ?>
            <p>Liste de tous les thésards sur la plateforme</p>
            <div class="table-responsive">
                <table class="table table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th class="bg-primary text-light">Prénom</th>
                            <th class="bg-primary text-light">Nom</th>
                            <th class="bg-primary text-light">E-mail</th>
                            <th class="bg-primary text-light">Nombre des publication</th>
                            <th class="bg-primary text-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        // Loop over thesards' info and display the information of each thesard
                        foreach($thesards as $thesard):
                        ?>
                            <tr>
                                <td><?=$thesard["prenom"]?></td>
                                <td><?=$thesard["nom"]?></td>
                                <td><?=$thesard["email"]?></td>
                                <td><?=$this->getNumberOfPublicationByThesardId($thesard["id"])?></td>
                                <td>
                                    <a class="btn btn-primary" href="publications.php?action=search&search=<?=$thesard["prenom"] . " " . $thesard["nom"] ?>&filter=thesard">
                                        <i class="fa-solid fa-eye fa-fw"></i>
                                        Voir les publication
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
        endif;  
    }
}
