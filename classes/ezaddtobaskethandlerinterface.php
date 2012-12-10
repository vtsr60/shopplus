<?php
/**
 * File containing the eZAddToBasketHandlerInterface interface.
 *
 */

interface eZAddToBasketHandlerInterface
{
    static public function preAdd( $object, $module, &$param );
    static public function postAdd( $object, $module, &$param );
}

?>
