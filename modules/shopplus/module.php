<?php
/**
 * File containing the ezie module definition
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 5.0.0-alpha1
 * @package ezie
 */

$Module = array( "name" => "ShopPlus",
                 "variable_params" => true );

$ViewList = array();
$ViewList["add"] = array(
    "functions" => array( 'buy' ),
    "script" => "add.php",
    "default_navigation_part" => 'ezshopnavigationpart',
    "params" => array( "ObjectID", "Quantity" ) );


$FunctionList = array();
$FunctionList['buy'] = array( );

?>
