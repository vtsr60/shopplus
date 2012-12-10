<?php
$http = eZHTTPTool::instance();
$module = $Params['Module'];

$sp_ini = eZINI::instance( 'shopplus.ini' );
$shopmodulename = trim($sp_ini->variable( 'ShopSettings', 'ShopModule' ));
$addviewname = trim($sp_ini->variable( 'ShopSettings', 'AddView' ));
if(!$shopmodulename || $shopmodulename == ''){
	eZDebug::writeError( "ShopModule setting is missing/not valid in shopplus.ini(ShopModule=$shopmodulename)." );
	return $module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}
if(!$addviewname || $addviewname == ''){
	eZDebug::writeError( "ShopModule setting is missing/not valid in shopplus.ini(AddView=$addviewname)." );
	return $module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

$shopModule = eZModule::exists( $shopmodulename );

if( $shopModule ){


    // Verify the ObjectID input
    if ( !$http->hasPostVariable( "ContentObjectID" ) || !is_numeric( $http->postVariable( "ContentObjectID" ) ) )
        return $module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

    $ObjectID = $http->postVariable( "ContentObjectID" );


    // Check if the object exists on disc
    if ( !eZContentObject::exists( $ObjectID ) )
        return $module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

    /* PRE HANDLER */
    $param = array();
    eZAddToBasketHandler::exec('preAdd', $ObjectID, $module, $param);

    $shopModule->forward( $shopModule, $addviewname );

    /* POST HANDLER */
    eZAddToBasketHandler::exec('postAdd', $ObjectID, $module, $param);

	if($shopModule->exitStatus() == eZModule::STATUS_REDIRECT)
		return $module->redirectTo( $shopModule->redirectURI() );
}
else{
	eZDebug::writeError( "ShopModule $shopmodulename dose not exists." );
	return $module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}
?>
