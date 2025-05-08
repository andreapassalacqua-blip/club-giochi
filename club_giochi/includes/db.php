<?php
// file che serve a includere la configurazione del database e stabilire la connessione

require_once __DIR__ . '/../config/config.php';

// Assicurati che il tuo config.php definisca queste variabili:
// $db_host (es. 'localhost')
// $db_name (es. 'club_giochi')
// $db_user (es. 'root')
// $db_pass (es. '') // Lascia vuoto se non hai impostato password per root

$host = $db_host;
$db   = $db_name;
$user = $db_user;
$pass = $db_pass;
$charset = 'utf8mb4'; // Un charset comune

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Fa in modo che PDO generi eccezioni in caso di errori
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Imposta il fetch mode di default su array associativi
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disabilita l'emulazione dei prepared statements per maggiore sicurezza
];

try {
    // Tenta di stabilire la connessione al database
    $pdo = new PDO($dsn, $user, $pass, $options);
    // La connessione è avvenuta con successo, l'oggetto PDO è disponibile come $pdo

} catch (\PDOException $e) {
    // Se la connessione fallisce, gestisci l'errore (mostralo durante lo sviluppo)
    // Durante lo sviluppo, puoi mostrare l'errore completo:
    throw new \PDOException($e->getMessage(), (int)$e->getCode());

    // In produzione, è meglio non mostrare dettagli sensibili dell'errore all'utente,
    // ma loggarli e mostrare un messaggio generico:
    // error_log('Errore di connessione al database: ' . $e->getMessage());
    // die('Siamo spiacenti, non riusciamo a connetterci al database in questo momento.');
}

// A questo punto, se la connessione ha avuto successo, la variabile $pdo
// contiene l'oggetto di connessione e può essere usata nelle altre pagine
// che includono db.php.
?>