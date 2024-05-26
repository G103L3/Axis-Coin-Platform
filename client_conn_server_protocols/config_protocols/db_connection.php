<?php
// Parametri di connessione al database
$host = "axiscoin-west-4607.8nj.gcp-europe-west1.cockroachlabs.cloud";
$port = "26257";
$dbname = "defaultdb";
$user = "axis-default";
$password = "KXISw7n7Dz8dGEH2DcEn3A";
$sslmode = "verify-full";

// Stringa di connessione
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password;sslmode=$sslmode";

try {
  // Connessione al database
  $conn = new PDO($dsn);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connessione al database effettuata con successo.";
} catch (PDOException $e) {
  echo "Errore di connessione al database: " . $e->getMessage();
}
?>