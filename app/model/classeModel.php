<?php 
function getElevesNotes(int $classeId, int $matiereId, int $periodeId) : array {
    $pdo = connexionDB();
    $sql = "SELECT e.id, e.nom, e.prenom, e.matricule,
            COALESCE(ev.devoir1,0) AS devoir1,
            COALESCE(ev.devoir2,0) AS devoir2,
            COALESCE(ev.composition,0) AS composition,
            ROUND((COALESCE(ev.devoir1,0) + COALESCE(ev.devoir2,0) + 2*COALESCE(ev.composition,0)) / 4.0, 2) AS moyenne,
            EXISTS (
                SELECT 1 FROM matiere_classes mc
                WHERE mc.classe_id = :classe_id AND mc.matiere_id = :matiere_id
            ) AS matiere_valide
            FROM inscriptions i
            INNER JOIN eleves e ON e.id = i.eleve_id
            LEFT JOIN evaluations ev
                ON ev.inscription_id = i.id
                AND ev.matiere_id = :matiere_id
                AND ev.periode_id = :periode_id
            WHERE i.classe_id = :classe_id
            ORDER BY e.nom";
    $data = ['classe_id' => $classeId, 'matiere_id' => $matiereId, 'periode_id' => $periodeId];
    $eleves = executeQuery($pdo, $sql, $data);
    $pdo = null;
    return $eleves;
}
?>