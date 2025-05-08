<?php
//includo l'intestazione HTML e del menu
include '../includes/header.php';

//includo il file che contiene la connessione al database
include '../includes/db.php';

// creo una Query in SQL dove seleziona tutti i giochi dall'archivio
$stmt = $pdo->query("SELECT * FROM giochi");

//salvo i risultati della query in un array
$giochi = $stmt->fetchAll();
?>
<main>
    <h2>Archivio Giochi</h2>    <!--titolo-->
    <ul>
        <?php foreach ($giochi as $gioco): ?>
            <!--creo un ciclo su ogni gioco e lo mostra in un <li> -->
            <li>
                <?= htmlspecialchars($gioco['nome']) ?> <!--mostra il nome del gioco in sicurezza -->
                - Quantità: <?= $gioco['quantita'] ?> <!--mostra quante copie ci sono -->
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php
//includo il  footer HTML
include '../includes/footer.php';
?>
