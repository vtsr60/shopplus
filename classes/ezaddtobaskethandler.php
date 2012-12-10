<?php

/**
 * eZAddToBasketHandler class
 *
 */
class eZAddToBasketHandler
{
    /**
     * Call preAdd or postAdd user definied functions.
     *
     * @static
     * @param string $method
     * @param array $result
     * @return bool
     */
    static function exec( $method, $ObjectID, $module, &$param)
    {
        $ini = eZINI::instance( 'shopplus.ini' );
        $handlers = $ini->variable( 'ShopSettings', 'AddToBasketHandler' );
        // Check if the user can read the object
        $object = eZContentObject::fetch( $ObjectID );

        if ( !$object && !$handlers && !isset($handlers[$object->attribute('class_identifier')])){
            return false;
        }
        else {
            if ( !call_user_func( array( $handlers[$object->attribute('class_identifier')], $method ), $object, $module, $param) )
                eZDebug::writeWarning( $handlers[$object->attribute('class_identifier')].' handler implementation not found' );
        }
        return true;
    }
}

?>
