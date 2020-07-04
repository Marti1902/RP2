$(document).ready(function(){
    var i = 0;
    localStorage.setItem( 'i', i );
    localStorage.setItem( 'ukupno', 0 );

    var kosarica = $( '<li id="idiukos" style="cursor: pointer;">Košarica <i class="fas fa-shopping-basket"></i></li>' );
    $( '.meni' ).append( kosarica );

    $( ".dodaj" ).on( 'click', function(){
        var info = $( this ).attr( 'id' );
        //console.log( info );
        var id = info.split( ", " );
        
        for( var j = 0; j < i; ++j ){
            var temp = localStorage.getItem( 'jelo' + j ).split( "," );
            console.log( temp[0] );
            console.log( id[0] );
            if( temp[0] === id[0] ){
                temp[3]++;
                localStorage.setItem( 'jelo' + j , temp );
                break;
            }
        }
    
        if( j === i ){
            id[3] = 1;
            localStorage.setItem( 'jelo' + i, id );
            i++;
            localStorage.setItem( 'i', i );
        }
    
        localStorage.setItem( 'ukupno', Number( localStorage.getItem( 'ukupno' ) ) + Number(id[2]));
    } );

    $( "#idiukos" ).on( 'click', show_form );

    var txt = $( "#txt_kvart" );
    // Kad netko nešto tipka u text-box:
    txt.on( "input", function(e)
    {
        var unos = $( this ).val(); // this = HTML element input, $(this) = jQuery objekt
    
        // Napravi Ajax poziv sa GET i dobij sva imena koja sadrže s kao podstring
        $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/restaurantsByNeighborhood.php',

            data:
            {
                q: unos
            },
            success: function( data )
            {
                console.log("tu");
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                $( "#datalist_kvartova" ).html( data );
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );
    } );

});


function show_form(){
    var div = $( '<div>' ), title = $( '<h2>' ), box = $( '<div>' ), close = $( '<span>' ), ul = $( '<ul>' );
    var naruci = $( '<button class="naruci"> Naruči! </button>' );
    var odbaci = $( '<button class="odbaci"> Odbaci narudžbu! </button>' );

    $( 'body' ).on( 'click', 'button.naruci', fja_naruci );
    $( 'body' ).on( 'click', 'button.odbaci', fja_odbaci );

    //ostale buttone zaključamo - nemožemo imat više otvorenih prozora
    //$( 'button' ).prop( 'disabled', 'true');
    var i = localStorage.getItem( 'i' );

    for( var j = 0; j < i; ++j ){
        if( localStorage.getItem( 'jelo' + j ) ){
            var temp = localStorage.getItem( 'jelo' + j ).split( "," );
            var li = $( '<li id="' + temp[0] + '">' );
            li.append( '' + temp[1] + '<br>' );
            li.append( '<div> Cijena: <span id="' + temp[0] + 'cijena">' + temp[2] + ' kn</span></div>');
            var kolicina = $( '<div id="kolicina"> Količina: <span id="' + temp[0] + 'puta">' + temp[3] + ' </span></div>' );
            var plus = $( '<button class="plus" id="' + j + '">' );
            var minus = $( '<button class="minus" id="' + j + '">' );
            plus.html( '+' );
            minus.html( '-' );
            kolicina.append( plus );
            kolicina.append( minus );
            li.append( kolicina );
            ul.append( li );            
        }     
    }

    $( 'body' ).on( 'click', 'button.plus', fja_plus );
    $( 'body' ).on( 'click', 'button.minus', fja_minus );

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
        .append( ul )
        .append( '<div> Ukupno: <span id="ukupno">' + localStorage.getItem( 'ukupno' ) + ' kn</span></div>' )
        .append( naruci )
        .append( odbaci );

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

    $(this).after(div);
}

function fja_naruci(){

}

function fja_odbaci(){
    localStorage.clear();
    show_form();
}

function fja_plus(){
    var i = $(this).attr( 'id' );
    var temp = localStorage.getItem( 'jelo' + i ).split( ',' );
    temp[3]++;
    localStorage.setItem( 'jelo' + i, temp );
    $( '#' + temp[0] + 'puta' ).html( temp[3] + ' ' );
    localStorage.setItem( 'ukupno', Number( localStorage.getItem( 'ukupno' ) ) + Number(temp[2]));
    $( '#ukupno' ).html( localStorage.getItem( 'ukupno' ) + ' kn' );
}

function fja_minus(){
    var i = $(this).attr( 'id' );
    var temp = localStorage.getItem( 'jelo' + i ).split( ',' );
    temp[3]--;
    localStorage.setItem( 'jelo' + i, temp );
    $( '#' + temp[0] + 'puta' ).html( temp[3] + ' ' );
    localStorage.setItem( 'ukupno', Number( localStorage.getItem( 'ukupno' ) ) - Number(temp[2]));
    $( '#ukupno' ).html( localStorage.getItem( 'ukupno' ) + ' kn' );
}

