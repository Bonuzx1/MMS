<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 14/02/2018
 * Time: 4:22 PM
 */
require_once '../class/PHPReports.php';

use PHPReports\PHPReports;

$pr = new PHPReports('f9nb3k8bzfumne6g6yu6fu4d');
$pr->setTemplateId(1);
$pr->setOutputFileType(PHPReports::OUTPUT_PDF);
$pr->setOutputAction(PHPReports::ACTION_GET_DOWNLOAD_URL);
$pr->setOutputFileName('My_Generated_Report.docx');
$pr->setTemplateVariables(
    array(
        'company_name' => 'Apple Inc.',
        'address'      => 'Istanbul / Turkey',
        'client_name'  => 'Murat Çileli',
        'products'     => array('Computer', 'Smart Phone', 'Book'),
        'quantities'   => array('4', '2', '3'),
        'prices'       => array('1290', '499', '10'),
        'totals'       => array('5160', '998', '30'),
        'total'        => '6.188',
    ));
$pr->generateReport();
