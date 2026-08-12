<?php 
    require_once dirname(__DIR__).'/config/database.php';
    require_once dirname(__DIR__).'/model/classeModel.php';

    function afficherNotes(){
        $matieres = getAllTable('matieres');
        $periodes = getAllTable('periodes');
        $classes = getAllTable('classes');
        $eleves = [];
        $classeId = 0;
        $matiereId = 0;
        $periodeId = 0;
        $moyenneClasse = 0;
        $erreurMatiere = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classeId = (int)($_POST['classe'] ?? 0);
            $matiereId = (int)($_POST['matiere'] ?? 0);
            $periodeId = (int)($_POST['periode'] ?? 0);

            if ($classeId != 0 && $matiereId != 0 && $periodeId != 0) {
                $resultat = getElevesNotes($classeId, $matiereId, $periodeId);

                if (!empty($resultat) && $resultat[0]['matiere_valide']) {
                    $eleves = $resultat;
                    $moyenneClasse = getMoyenneClasse($classeId, $matiereId, $periodeId);
                } else {
                    $erreurMatiere = true;
                }
            }
        }
    var_dump($classeId, $matiereId, $periodeId, $moyenneClasse);
        require_once dirname(__DIR__).'/view/notes.html.php';
    }

        