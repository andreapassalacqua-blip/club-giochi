<?php
//includo l'intestazione HTML
include '../includes/header.php';

//mi connetto al DB
include '../includes/db.php';

// creo una Query SQL la quale seleziona i prestiti unendo giochi e soci per mostrare info leggibili
$stmt = $pdo->query("
    SELECT p.*, g.nome AS gioco_nome, s.nome AS socio_nome
    FROM prestiti p
    JOIN giochi g ON p.id_gioco = g.id
    JOIN soci s ON p.id_socio = s.id
");

//prendo tutti i risultati
$prestiti = $stmt->fetchAll();
?>
<main>
    <h2>Prestiti in corso</h2>
    <ul>
        <?php foreach ($prestiti as $prestito): ?>
            <li>
                <!--mostra chi ha preso cosa e quando -->
                <?= $prestito['socio_nome'] ?> ha preso
                "<?= $prestito['gioco_nome'] ?>" il <?= $prestito['data_prestito'] ?>
                
                <!--se è stato restituito, mostra anche la data -->
                <?= $prestito['data_restituzione'] ? "(restituito il {$prestito['data_restituzione']})" : '' ?>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include '../includes/footer.php'; ?>
