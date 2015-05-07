<?php

$aReturn[ 'text' ] = '';
if( !empty( $_GET ) )
{
    if( $_GET[ 'type' ] == 'games' )
    {
        $aReturn[ 'text' ] = 'Text for games';
        var_dump($aReturn);
    }
    else if( $_GET[ 'type' ] == 'books' )
    {
        $aReturn[ 'text' ] = 'Text for books';
    }
    else if( $_GET[ 'type' ] == 'comics' )
    {
        $aReturn[ 'text' ] = 'Text for comics';
    }
}
header( 'Content-Type: application/json' );
$sJson = json_encode( $aReturn, 1 );
echo $sJson;
