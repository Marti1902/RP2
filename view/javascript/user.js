$(document).ready(function(){
    var i = 0;

    $( "#footer" ).css( 'position', 'fixed' )
        .css( 'bottom', '0' )
        .css( 'width', '100%' )
        .css( 'left', '0' )
        .css( 'background-color', 'white' )
        .css( 'text-align', 'center' )
        .html( '<button id="idiukos">Idi u košaricu</button>' );
    //$( '#kosarica' ).css( 'display', 'none' );

    $(".dodaj").on('click', function() {
        var info = $( this ).attr( 'id' );
        //console.log( info );
        var id = info.split( ", " );
        //console.log( id );
        for( var j = 0; j < i; ++j ){
            var temp = localStorage.getItem( 'jelo' + j ).split( ", " );
            console.log( temp );
            console.log( id );
            if( temp[0] === id[0] ){
                temp[3]++;
                localStorage.setItem( temp[0], temp );
            }
        }
        if( j === i ){
            id[3] = 1;
            localStorage.setItem( 'jelo' + i, id );
            i++;
        }
        
        
        /*$( "#naruceno" ).children( 'li' ).each( function() {
            if( $( this ).attr( 'id'  ) == id[0] ){
                var s = $( "#" + id[0] + "puta" ).html();
                //console.log( s );
                $( "#" + id[0] + "puta" ).html( parseInt( s ) + 1);
                //var c = $( '#cijena' ).html();
                //$( '#cijena' ).html( parseInt( c ) + parseInt( id[2] ) );
                p = false;
            }
        } );

        if( p ){
            $( "#naruceno" ).append( '<li id="' + id[0] + '">' );
            $( "#" + id[0] ).append( '' + id[1] + '<br>' );
            $( "#" + id[0] ).append( '<div>Cijena: <span id="' + id[0] + 'cijena">' + id[2] + ' kn</span></div>' );
            $( '#' + id[0] ).append( '<div id="kolicina">Količina: <span id="' + id[0] + 'puta">1</span></div>');
            //var c = $( '#cijena' ).html();
            //$( '#cijena' ).html( parseInt( c ) + parseInt( id[2] ) );
        }
        var c = $( '#cijena' ).html();
        $( '#cijena' ).html( parseInt( c ) + parseInt( id[2] ) + ' kn' );
        */
    });

    $( "#idiukos" ).on( 'click', show_form );
        /*function() {
        console.log('radi');
        w = $( window ).width();
        h = $( window ).height();
        $('#naruci')
            .css('position','absolute')
            .css('right',160)
            .css('bottom',5);
        $('#odbaci')
            .css('position','absolute')
            .css('right',5)
            .css('bottom',5);
        $( '#kosarica' )
            .css( 'display', 'inline' )
            .css( 'position', 'absolute')
            .css( 'left', 0.1 * w )
            .css( 'top', 0.1 * h)
            .css( 'height', 0.3 * h )
            .css( 'width', 0.8 * w )
            .css( 'background-color', '#BEBEBE')
            .css('border', '2px solid gray')
            .css('border-radius','5px');
        if ( !$( "#close" ).length ) {
            var close = $( '<button id = "close">' )
                .css( 'position', 'absolute' )
                .css( 'top', 5 )
                .css( 'right', 5 )
                .css( 'background-color', 'gray')
                .css('border', '2px solid gray')
                .css('border-radius','5px')
                .css( 'height', ((h+w)/60) + 'px' )
                .css( 'width', ((h+w)/60) + 'px' )
                .css( 'font-size', ((h+w)/100) + 'px' )
                .html( 'X' );
            $( "#kosarica" ).append( close );
        }
        $( "#close" ).on( 'click', function(){
            $( '#kosarica' ).css( 'display', 'none' );
            console.log( 'closea' );
        });
    });*/

    $( "#odbaci" ).on( 'click', function(){
        $( "#naruceno" ).html( '' );
        $( "#cijena" ).html( '0 kn' );
    });

    $("#naruci").on('click',function(){
        

    });

});

function show_form()
{
    var div = $( '<div>' ), title = $( '<h2>' ), box = $( '<div>'), close = $( '<span>' ), ul = $( 'ul' );

    //ostale buttone zaključamo - nemožemo imat više otvorenih prozora
    //$( 'button' ).prop( 'disabled', 'true');

    title.html( 'Košarica' )
        .css( 'color', 'black' );

    // link za zatvaranje boxa i okvira
    close.html('&times')
        .css( 'color', '#aaaaaa' )
        .css( 'float', 'right' )
        .css( 'font-size', '35')
        .css( 'font-weight', 'bold')
        .on( 'click', function(event){
            div.css('display', 'none' );
        })         
        .focus(function(){          // ne , drugačije riješit
            $(this).css( 'color', 'black' )
                    .css( 'text-decoration', 'none' )
                    .css( 'cursor', 'pointer' );
        })
        .hover(function(){
            $(this).css( 'color', 'black' )
                    .css( 'text-decoration', 'none' )
                    .css( 'cursor', 'pointer' );
        });

    
     //  box za text i ostalo unutra okvira
     box.css( 'background-color', '#fefefe')
        .css( 'margin', 'auto')
        .css( 'padding', '20px')
        .css( 'border', '1px solid, /888')
        .css( 'width', '80%' )
        .prop( 'class', 'box')
        .append( close )
        .append( title )
        .append( '#naruceno' );

    //  vanjski okvir    
    div.css( 'position', 'fixed')
        .css('display', 'block')
        .css( 'text-align', 'center')
        .css('top', '0%')
        .css('left', '0%')
        .css( 'padding-top', '100px')
        .css('height', '100%')
        .css( 'width', '100%' )
        .css( 'z-index', '1')
        .css( 'background-color', 'rgba(0,0,0,0.4)' )
        .css( 'overflow', 'auto' )
        .prop( 'class', 'okvir');
        
    
    div.append(box);

    //   Zatvara prozor ako se klikne van boxa
    /*div.on( 'click', function(event){
            if( $(event.target).attr('class') === 'okvir' )
                destroy( $(event.target) );
        });*/


    $(this).after(div);
}
