$(document).ready(function(){
    if( localStorage.getItem( 'i' ) === null )
        localStorage.setItem( 'i', 0 );

    if( localStorage.getItem( 'ukupno' ) === null )
        localStorage.setItem( 'ukupno', 0 );

    var nas = $( '#naslov' ).html();
    console.log( nas );

    if( nas !== 'Moje narudžbe' && nas !== 'Vaši omiljeni restorani' && nas !== 'Svi restorani' && nas != 'Kvartovi' && nas != 'Restorani prema vrsti hrane' && nas != 'Popularni restorani' && !nas.includes( "Restorani u kvartu" ) ){
        var kosarica = $( '<li class="nav-item" id="idiukos" style="cursor: pointer;"><a class="nav-link">Košarica <i class="fas fa-shopping-basket"></i></a></li>' );
        kosarica.css( 'float', 'right' );
        $( '.navbar-nav' ).append( kosarica );
        if( localStorage.getItem( 'restoran' ) === null )
            localStorage.setItem( 'restoran', nas );
        else if( localStorage.getItem( 'restoran' ) !== nas ){
            localStorage.clear();
            localStorage.setItem( 'ukupno', 0 );
            $( '#jela' ).remove();
            $( '#ukupno' ).html( localStorage.getItem( 'ukupno' ) + ' kn' );
            localStorage.setItem( 'restoran', nas );
        }
    }
    else{
        localStorage.clear();
    }

    $( "button[klasa='dodaj']" ).on( 'click', function(){
        var info = $( this ).attr( 'id' );
        //console.log( info );
        var id = info.split( ", " );
        var i = Number( localStorage.getItem( 'i' ) );
        
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
            id[4] = $( this ).attr( 'img' );
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

    $( "button[klasa='thumbs']" ).on( 'click', function(){
        var ord = $( this ).attr( 'id' );
        var novi = parseInt( $( this ).html() ) + 1;
        if( $( this ).attr( 'palac' ) == 'gori' ) tip = 'gori';
        else if( $( this ).attr( 'palac' ) == 'doli' ) tip = 'doli';
        $( this ).html( novi );
        console.log( ord, novi, tip );
        $.ajax(
            {
                url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/changeThumbs.php',
                method: 'post',
                data:
                {
                    id: ord,
                    thumbs: novi,
                    vrsta: tip
                },
                success: function( data )
                {
                    if( data.hasOwnProperty( 'greska' ) ){
                        console.log( data.greska );
                    }
                    else if( data.hasOwnProperty( 'rezultat' ) ){
                        console.log( data.rezultat );
                    }
                },
                error: function()
                {
                    console.log( 'Greška u Ajax pozivu...');
                }
            });
    } );

});


function show_form(){
    var div = $( '<div>' ), title = $( '<h2>' ), box = $( '<div>' ), close = $( '<span>' ), ul = $( '<ul id="jela">' );
    var naruci = $( '<button class="naruci"> Naruči! </button>' );
    var odbaci = $( '<button class="odbaci"> Odbaci narudžbu! </button>' );

    $( 'body' ).on( 'click', 'button.naruci', fja_naruci );
    $( 'body' ).on( 'click', 'button.odbaci', fja_odbaci );

    var i = localStorage.getItem( 'i' );

    for( var j = 0; j < i; ++j ){
        if( localStorage.getItem( 'jelo' + j ) ){
            var temp = localStorage.getItem( 'jelo' + j ).split( "," );
            var li = $( '<li id="' + temp[0] + '">' );
            var img = $( '<img src="' + location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + temp[4] + '"width="100" height="100"><br>' );
            img.css( 'margin-left', '0' );
            li.append( img );
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
        .css( 'cursor', 'pointer' )
        .on( 'click', function(event){
            destroy($(event.target));
        })
        .on({
            mouseenter: function () {
                $(this).css('color', 'black')
            },
            mouseleave: function () {
                $(this).css( 'color', '#aaaaaa' );
            }
        });

    var u, d = 1, trenutno = $( this );
    var usr = $( '#idjevi' ).attr( 'id_user' ), d = 1;
    console.log( usr );
    $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/checkDiscount.php',
            method: 'post',
            data:
            {
                id_user: usr
            },
            success: function( data )
            {
                if( data.hasOwnProperty( 'greska' ) ){
                    console.log( data.greska );
                    p.html( 'ERROR in database' + data.greska);
                }
                else if( data.hasOwnProperty( 'rezultat' ) ){
                    console.log( 'kolko ' + data.rezultat );
                    if( parseInt( data.rezultat ) % 10 == 0 && parseInt( data.rezultat ) != 0 ) d = 0.9;
                    else d = 1;
                    console.log( d );
                    u = parseFloat(localStorage.getItem( 'ukupno' ) ) * d;
                    localStorage.setItem( 'spopustom', u );
                    var pop = $( '<div id="pop">' );
                    if( d == 0.9 && localStorage.getItem( 'ukupno' ) != 0 ) pop.html( 'Ostvarili ste popust!' );
                    
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
                        .append( pop )
                        .append( '<div name="uk"> Ukupno: <span id="ukupno">' + u + ' kn</span></div>' )
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
                
                    trenutno.after(div);
                }
            },
            error: function()
            {
                console.log( 'Greška u Ajax pozivu...');
            }
        });
}

function fja_naruci() {
    if( localStorage.getItem( 'ukupno' ) !== '0' ){
        var posalji = $( '<button class="posalji"> Pošalji narudžbu! </button>' );
        var span = $( '<span name="adresa"> <br> Adresa: </span>' );
        var napomena = $( '<div name="napomena">' );
        var komentar = $( '<textarea name="note">' );
        napomena.html( 'Napomena restoranu i/ili dostavljaču: ' );
        napomena.append( komentar );
        $( 'body' ).on( 'click', 'button.posalji', fja_posalji_narudzbu );
        $( '.naruci' ).hide();
        $( '.plus' ).hide();
        $( '.minus' ).hide();

        var adresa = $( '#gl_adresa' ).attr( 'gl_adresa' );
        var input = $( '<input name="adresa">' );
        input
            .prop( 'type', 'text' )
            .attr( 'value', adresa );

        span.append( input );
        $( '.box' ).append( span );
        $( '.box' ).append( '<br>' );
        $( '.box' ).append( napomena );
        $( '.box' ).append( '<br>' );
        $( '.box' ).append( posalji );
        $( '.box' ).append( $( '.odbaci' ) );
    }
    else{
        $( '.box' ).append( $( '<br><span>Morate dodati jelo u košaricu kako biste mogli naručiti.</span>') );
        $( '.naruci' ).hide();
        $( '.odbaci' ).hide();
        $( 'div[name="uk"]').hide();
    }
}

function fja_posalji_narudzbu(){
    var id_restaurant = $( '#idjevi' ).attr( 'id_restaurant' );
    var id_user = $( '#idjevi' ).attr( 'id_user' );
    var price_total = localStorage.getItem( 'ukupno' );
    var note = $( 'textarea[name="note"]' ).val();
    var address = $( 'input[name="adresa"]' ).val();
    var id_food = [];
    var quantity = [];
    var disc = 0;
    if( $( "#pop" ).html() == "Ostvarili ste popust!" ) disc = 10.00;
    else disc = 0.00;
    console.log( price_total, id_restaurant, id_user, disc );

    var i = localStorage.getItem( 'i' );

    for( var j = 0; j < i; ++j ){
        if( localStorage.getItem( 'jelo' + j ) ){
            var temp = localStorage.getItem( 'jelo' + j ).split( "," );
            id_food[j] = temp[0];
            quantity[j] = temp[3];
        }     
    }

    $.ajax( {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/userOrder.php',
            method: 'get',
            data: {
                id_user: id_user,
                id_restaurant: id_restaurant,
                active: 1,
                price_total: price_total,
                discount: disc,
                note: note,
                address: address,
                id_food: id_food,
                quantity: quantity
            },
            success: function( data )
            {
                if( data.hasOwnProperty( 'greska' ) ){
                    $( '.box' ).append( '<span>Greška pri slanju narudžbe! Molim Vas pokušajte ponovno za nekoliko sekundi.</span>' );
                    console.log( data.greska );
                }
                else if( data.hasOwnProperty( 'rezultat' ) ){
                    console.log( data.rezultat );
                    localStorage.clear();
                    localStorage.setItem( 'ukupno', 0 );
                    $( "#pop" ).html( '' );
                    $( '#jela' ).remove();
                    $( 'div[name="napomena"]' ).remove();
                    $( 'span[name="adresa"]' ).remove();
                    $( '#ukupno' ).remove();
                    //$( 'div[name="uk"]').html( 'Narudžba poslana restoranu. Za više detalja pogledajte <a href="<?php echo __SITE_URL; ?>/index.php?rt=user/orders">Moje narudžbe</a>.' )
                    $( 'div[name="uk"]' ).append( $("#povratna") );
                    $( "#povratna" ).removeAttr( 'hidden' );
                    $( '.posalji' ).hide();
                    $( '.odbaci' ).hide();
                }
            },
            error: function()
            {
                console.log( 'Greška u Ajax pozivu...');
            }
        });
}

function fja_odbaci(){
    localStorage.clear();
    localStorage.setItem( 'ukupno', 0 );
    $( "#pop" ).html( '' );
    $( '#jela' ).remove();
    $( 'div[name="napomena"]' ).remove();
    $( 'span[name="adresa"]' ).remove();
    $( '#ukupno' ).remove();
    $( 'div[name="uk"]').html( 'Odbacili ste narudžbu.' );
    $( '.posalji' ).remove();
    $( '.naruci' ).remove();
    $( '.odbaci' ).remove();
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
    if( Number( temp[3] ) !== 0 ){
        temp[3]--;
        localStorage.setItem( 'jelo' + i, temp );
        $( '#' + temp[0] + 'puta' ).html( temp[3] + ' ' );
        localStorage.setItem( 'ukupno', Number( localStorage.getItem( 'ukupno' ) ) - Number(temp[2]));
        $( '#ukupno' ).html( localStorage.getItem( 'ukupno' ) + ' kn' );
    }
}

function destroy( vari = null)
{
    var parent = vari;
    if( parent.attr('class') === 'okvir' )
        parent.remove();
    if( (parent = parent.parent() ).attr('class') === 'okvir' )
        parent.remove();
    else
        parent.parent().remove();
    location.reload();
    
}