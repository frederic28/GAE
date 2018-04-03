<?php
// service : charge
// api : /charge/send/v1
// date : 12/03/2018
// auteur : h.Trannois

// Test le site
// execute des requêtes http de type GET sur la home page du service par defaut.
// input : prend en entrée le nombre de requêtes à faire ( 10 par defaut )
// outpout : données de type x-json-charge ensemble de clef/valeur
//  exemple :   {
//                  serie : [ valeur, ... ]
//              }

require 'vendor/autoload.php';

// nombre de requêtes à lancer valeur par défaut
$nbr = 10;
if ( isset( $_POST['nbr_requests'] )) {
    $nbr = $_POST['nbr_requests'];
}

// Tableau enregistrant la durée des requêtes
$data = [];

try {
    // configuration des requêtes (elles sont https en production)
    $client = new \GuzzleHttp\Client([
        'base_uri' => ( $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'). $_SERVER['DEFAULT_VERSION_HOSTNAME'],
        'timeout' => 2.0,
        'verify' => false,
    ]);


    // boucle effectuant les requêtes
    for ($i = 0; $i < $nbr; $i++) {

        $start = microtime(true);
        $req = $client->request('GET', '/index.php');
        $diff = microtime(true) - $start; // calcule du delay

        // si la réponse n'est pas bonne on donne un dela
        if ( $req->getStatusCode() == '200' ) {
            array_push( $data, $diff );
        } else {
            array_push( $data, -1 );
        }
    }

    $moyenne = 0;
    $nbrBonneValeur = 0;
    foreach ($data as $val ) {
        if ( $val != -1 ) {
            $moyenne += $val;
            $nbrBonneValeur++;
        }
    }
    $moyenne /= $nbrBonneValeur;

} catch ( \GuzzleHttp\Exception\ClientException $e ) {
    error_log( $e->getMessage());
}

// envoie de la réponse au format text/json
header('content-type:text/json');

$payload = [ 'serie' => $data, 'moyenne' => $moyenne ];
echo json_encode($payload);
