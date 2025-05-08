<?php // Definizione dei parametri per connettersi al database
$db_host = 'localhost'; // o l'indirizzo del server DB
$db_name = 'club_giochi'; // il nome del tuo database
$db_user = 'root'; // il nome utente del database
$db_pass = ''; // la password (spesso vuota per root su XAMPP)

//decido di usare il blocco try-catch per tentare la connessione e catturare eventuali errori
try {
    //creazione dell'oggetto PDO per connettersi al DB
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    
    //ompostazione del modo in cui PDO gestisce gli errori (lancia eccezioni)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //se c'è un errore nella connessione, il programma si ferma e stampa il messaggio
    die("Errore di connessione al DB: " . $e->getMessage());
}
?>
