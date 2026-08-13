<?php 

function getElevesNotes(int $classeId, int $matiereId, int $periodeId) : array {
    $pdo = connexionDB();
    $sql = "SELECT id, nom, prenom, matricule, devoir1, devoir2, composition, moyenne, matiere_valide,
                CASE
                    WHEN moyenne >= 16 THEN 'Très bien'
                    WHEN moyenne >= 14 THEN 'Bien'
                    WHEN moyenne >= 12 THEN 'Assez bien'
                    WHEN moyenne >= 10 THEN 'Passable'
                    ELSE 'Insuffisant'
                END AS appreciation
            FROM (
            SELECT e.id, e.nom, e.prenom, e.matricule,
                COALESCE(ev.devoir1,0) AS devoir1,
                COALESCE(ev.devoir2,0) AS devoir2,
                COALESCE(ev.composition,0) AS composition,
                ROUND((COALESCE(ev.devoir1,0) + COALESCE(ev.devoir2,0) + 2*COALESCE(ev.composition,0)) / 4.0, 2) AS moyenne,
                EXISTS (
                    SELECT 1 FROM matiere_classes mc
                    WHERE mc.classe_id = :classe_id AND mc.matiere_id = :matiere_id
                ) AS matiere_valide
            FROM inscriptions i
            INNER JOIN anneescolaires a ON a.id = i.annee_id
            INNER JOIN eleves e ON e.id = i.eleve_id
            LEFT JOIN evaluations ev
                ON ev.inscription_id = i.id
                AND ev.matiere_id = :matiere_id
                AND ev.periode_id = :periode_id
            WHERE i.classe_id = :classe_id
                AND a.estactif = 1
            ) AS sous_requete
            ORDER BY nom";
    $data = ['classe_id' => $classeId, 'matiere_id' => $matiereId, 'periode_id' => $periodeId];
    $eleves = executeQuery($pdo, $sql, $data);
    $pdo = null;
    return $eleves;
}

function getMoyenneClasse(int $classeId, int $matiereId, int $periodeId) : float {
    $pdo = connexionDB();
    $sql = "SELECT ROUND(COALESCE(AVG(moyenne_eleve), 0), 2) AS moyenne_classe
            FROM (
                SELECT i.id,
                    (COALESCE(ev.devoir1,0) + COALESCE(ev.devoir2,0) + 2*COALESCE(ev.composition,0)) / 4.0 AS moyenne_eleve
                FROM inscriptions i
                INNER JOIN anneescolaires a ON a.id = i.annee_id
                LEFT JOIN evaluations ev
                    ON ev.inscription_id = i.id
                    AND ev.matiere_id = :matiere_id
                    AND ev.periode_id = :periode_id
                WHERE i.classe_id = :classe_id
                AND a.estactif = 1
                AND (ev.devoir1 IS NOT NULL OR ev.devoir2 IS NOT NULL OR ev.composition IS NOT NULL)
            ) AS sous_requete";
    $data = ['classe_id' => $classeId, 'matiere_id' => $matiereId, 'periode_id' => $periodeId];
    $result = executeQuery($pdo, $sql, $data, true);
    $pdo = null;
    return (float)$result['moyenne_classe'];
}

function getAnneeActive() : string {
    $pdo = connexionDB();
    $sql = "SELECT nom FROM anneescolaires WHERE estactif = 1 LIMIT 1";
    $result = executeQuery($pdo, $sql, [], true);
    $pdo = null;
    return $result['nom'] ?? '';
}
?>