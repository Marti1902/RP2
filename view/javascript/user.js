$(document).ready(function(){
    $( "#footer" ).css( 'position', 'fixed' )
        .css( 'bottom', '0' )
        .css( 'width', '100%' )
        .css( 'left', '0' )
        .css( 'background-color', 'red' )
        .css( 'color', 'white' )
        .css( 'text-align', 'center' )
        .html( '<button id="idiukos">Idi u košaricu</button>' );
    $( '#kosarica' ).css( 'display', 'none' );

    $(".dodaj").on('click', function() {
        var info = $( this ).attr( 'id' );
        console.log( 'usa' );
        var id = info.split( ", " ), p = true;
        console.log( id );
        $( "#naruceno" ).children( 'li' ).each( function() {
            if( $( this ).attr( 'id'  ) == id[0] ){
                var s = $( "#" + id[0] + "puta" ).html();
                console.log( s );
                $( "#" + id[0] + "puta" ).html( parseInt( s ) + 1);
                //var c = $( '#cijena' ).html();
                //$( '#cijena' ).html( parseInt( c ) + parseInt( id[2] ) );
                p = false;
            }
        } );
        if( p ){
            $( "#naruceno" ).append( '<li id="' + id[0] + '">' );
            $( "#" + id[0] ).append( '' + id[1] + '<br>' );
            $( "#" + id[0] ).append( '<div id="' + id[0] + 'cijena">' + id[2] + '</div>' );
            $( '#' + id[0] ).append( 'Količina: <div id="' + id[0] + 'puta">1</div');
            //var c = $( '#cijena' ).html();
            //$( '#cijena' ).html( parseInt( c ) + parseInt( id[2] ) );
        }
        var c = $( '#cijena' ).html();
        $( '#cijena' ).html( parseInt( c ) + parseInt( id[2] ) );
    });

    $( "#idiukos" ).on( 'click', function() {
        console.log('radi');
        w = $( window ).width();
        h = $( window ).height();
        $( '#kosarica' )
            .css( 'display', 'inline' )
            .css( 'position', 'absolute')
            .css( 'left', 0.1 * w )
            .css( 'top', 0.1 * h)
            .css( 'height', 0.8 * h )
            .css( 'width', 0.8 * w )
            .css( 'background-color', 'grey');
        if ( !$( "#close" ).length ) {
            var close = $( '<button id = "close">' )
                .css( 'position', 'absolute' )
                .css( 'top', 0 )
                .css( 'right', 0 )
                .css( 'background-color', 'red')
                .css( 'height', ((h+w)/50) + 'px' )
                .css( 'width', ((h+w)/25) + 'px' )
                .css( 'font-size', ((h+w)/100) + 'px' )
                .html( 'X' );
            $( "#kosarica" ).append( close );
        }
        $( "#close" ).on( 'click', function(){
            $( '#kosarica' ).css( 'display', 'none' );
            console.log( 'closea' );
        });
    });

    $( "#odbaci" ).on( 'click', function(){
        $( "#naruceno" ).html( '' );
        $( "#cijena" ).html( '0' );
    });

});