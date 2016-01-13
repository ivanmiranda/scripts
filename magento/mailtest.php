<?php
// Prueba de correo
if (!isset($_GET['email'])) {
    echo 'uso: mailtest.php?email=correo@dominio.com';
    die;
}
 
// Enviar el correo al estílo de Magento
require_once('app/Mage.php');
Mage::app();
 
// Crear un 'formulario de contacto'
$emailTemplate = Mage::getModel('core/email_template')
    ->loadDefault('contacts_email_email_template');
$data = new Varien_Object();
$data->setData(    
    array(
        'name' => 'Juanito',
        'email' => 'juanito@frijoles.com',
        'telephone' => '123-4567890',
        'comment' => 'Esto es una prueba'
    )
);
$vars = array('data' => $data);
 
// Asignar la informacion de quien envia
$storeId = Mage::app()->getStore()->getId();
$emailTemplate->setSenderEmail(
    Mage::getStoreConfig('trans_email/ident_general/email', $storeId));
$emailTemplate->setSenderName(
    Mage::getStoreConfig('trans_email/ident_general/name', $storeId));
$emailTemplate->setTemplateSubject('Prueba de correo');
 
// Enviar el correo
$output = $emailTemplate->send($_GET['email'], null, $vars);
var_dump($output);
