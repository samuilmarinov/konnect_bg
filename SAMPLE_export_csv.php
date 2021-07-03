<?php

define( 'BLOCK_LOAD', true );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' );
$wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

global $wpdb;

header('Content-Type: text/csv');
$FileName = 'Content-Disposition: attachment; filename="'. 'Report.csv"';
header($FileName);

$fp = fopen('php://output', 'w');
    
$header_row = array(
        0 => 'name',
        1 => 'email',
        2 => 'phone',
        3 => 'service',
        4 => 'vehicle',
        5 => 'pickup_time',
        6 => 'return_time',
        7 => 'pickup',
        8 => 'destination',
        9 => 'created_at',
    );
fputcsv($fp, $header_row); 

$prefix = 'WXY_';
$table_name = $prefix . 'submissions'; 

$rows = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id` DESC");


if(!empty($rows)) 
{
foreach($rows as $Record)
    {      
    // where data1, data2, data3 are the database column names 
    $OutputRecord = array($Record->name, $Record->email, $Record->phone, $Record->service, $Record->vehicle, $Record->pickup_time, $Record->return_time, $Record->pickup, $Record->destination, $Record->created_at);
    fputcsv($fp, $OutputRecord);         
    }
    unset($rows);
}

fclose( $fp );
    
die;


?>

