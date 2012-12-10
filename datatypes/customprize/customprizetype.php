<?php

/*!
  \class CustomPrizeType customprizetype.php
  \ingroup eZDatatype
  \brief A content datatype which adding custom prize calculator

*/

class CustomPrizeType extends eZDataType
{
    const DATA_TYPE_STRING = "customprize";

    function CustomPrizeType()
    {
        $this->eZDataType( self::DATA_TYPE_STRING, ezpI18n::tr( 'kernel/classes/datatypes', "Custom Prize", 'Datatype name' ),
                           array( 'serialize_supported' => true ) );
    }

    /*!
     Returns the content.
    */
    function objectAttributeContent( $contentObjectAttribute )
    {
        $object = eZContentObject::fetch( $contentObjectAttribute->attribute('contentobject_id'));
        return eZCustomPrizeHandler::exec('calculatePrize', $object);
    }


    function toString( $contentObjectAttribute )
    {
        $content = $contentObjectAttribute->attribute('content');
        if($content)
            return $content->attribute( 'price' );
        return '';
    }

    function hasObjectAttributeContent( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'content' ) !== null;
    }

    function isInformationCollector()
    {
        return false;
    }

    /*!
     \return true if the datatype can be indexed
    */
    function isIndexable()
    {
        return false;
    }

}

eZDataType::register( CustomPrizeType::DATA_TYPE_STRING, "CustomPrizeType" );

?>
