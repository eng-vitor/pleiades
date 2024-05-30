<?php
require __DIR__ .'./vendor/autoload.php';
# ------------------------------------------------------------------------------
# Pleiades
# ------------------------------------------------------------------------------
date_default_timezone_set('America/Belem');
$SERVER_NAME = 'Pleiades';
$SYSTEM_VERSION = 'v0.2.1';
# ------------------------------------------------------------------------------
# Database config
# ------------------------------------------------------------------------------
$DB_SERVER = '127.0.0.1:3306';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB = 'pleiades';

try{
    $CONNECTION_DB = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB);
}catch(Exception $edb){
    $errordb = $edb->getMessage();
}
# ------------------------------------------------------------------------------
# Ticket system parameters
# ------------------------------------------------------------------------------
$TICKET_TEAM = ['Frontend','Backend','Network Operation Center','DevOps'];
$TICKET_SLA = [8,12,24,48]; // Horas/hours
$RESULTS_PER_PAGE = 10;