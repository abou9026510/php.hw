<?php
function crudBieren(){

    // Menu-Item   insert
    $txt = "
    <h1>Crud BIER</h1>
    <nav>
        <a href='insert_bier.php'>Toevoegen nieuw biertje</a>
    </nav>";
    echo $txt;

    // haal alle bier records uit de tabel
    $result = GetData("bier");


}

// selecteer de data uit de opgegeven table
function GetData($table){
    // connect database
    $conn = ConnectDb();

    
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll();

    var_dump($result);
    return $result;
}

function ConnectDb() {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bieren";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    return $conn;
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
}

//print table
//printCrudBier($result);
