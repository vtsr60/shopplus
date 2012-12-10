<?php

/**
 * eZAddToBasketHandler class
 *
 */
class eZCustomPrizeHandler
{
    /**
     * Call calculatePrize user definied functions.
     *
     * @static
     * @param string $object
     * @param array $result(instance of eZSinglePrize)
     * @return bool
     */
    static function exec( $method, $object)
    {

        $ini = eZINI::instance( 'shopplus.ini' );
        $handlers = $ini->variable( 'PriceSettings', 'CustomPrizeHandler' );

        if ( !$object && !$handlers && !isset($handlers[$object->attribute('class_identifier')])){
            return false;
        }
        else {
            return call_user_func( array( $handlers[$object->attribute('class_identifier')], $method ), $object);
        }
        return null;
    }
}

?>
