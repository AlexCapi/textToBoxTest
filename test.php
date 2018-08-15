<?php
require_once(dirname(__FILE__) . '/No2SMS_Client.class.php');

/* on définit ici en "dur" les variables nécessaires dans le cadre de l'exercice demandé */
$user        = "devjob";
$encrypted    = "cG9vcmx5Y29kZWRwYXNzd29yZA==";
$destination = "+410765363776";
$message     = "Alexandre CAPELLARO : https://github.com/AlexCapi/textToBoxTest/blob/master/test.php";

/* on décrypte le mot de passe (très complexe) avant la connexion du client */
$password = base64_decode($encrypted);

/* on crée un nouveau client pour l'API */
$client = new No2SMS_Client($user, $password);

try {
    /* test de l'authentification */
    if (!$client->auth())
        die('mauvais utilisateur ou mot de passe');

    /* envoi du SMS */
    print "===> ENVOI\n";
    $res = $client->send_message($destination, $message);
    var_dump($res);
    $id = $res[0][2];
    printf("SMS-ID: %s\n", $id);

    print "===> STATUT\n";
    $res = $client->get_status($id);
    var_dump($res);

} catch (No2SMS_Exception $e) {
    printf("!!! Problème de connexion: %s", $e->getMessage());
    exit(1);
}
