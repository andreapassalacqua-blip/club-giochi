<?php
include '../includes/header.php';

//connessione al DB
include '../includes/db.php';

// creo una Query SQL per selezionare tutti gli incontri ordinati dal più recente
$stmt = $pdo->query("SELECT * FROM incontri ORDER BY data_incontro DESC");

//salvo i dati degli incontri
$incontri = $stmt->fetchAll();
?>
<main>
    <h2>Incontri recenti</h2>
    <ul>
        <?php foreach ($incontri as $incontro): ?>
            <li>
                <!--mostra la data dell'incontro -->
                Data: <?= $incontro['data_incontro'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include '../includes/footer.php'; ?>
