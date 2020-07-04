$( document ).ready( function(){
    var ord;
    $( ".ocijeni" ).on( 'click', show_form);
})

function show_form()
{
    var div = $( '<div>' ), title = $( '<h2>' ), box = $( '<div>'), close = $( '<span>' );

    //ostale buttone zaključamo - nemožemo imat više otvorenih prozora
    //$( 'button' ).prop( 'disabled', 'true');

    title.html( 'Ocijeni ovu narudžbu' )
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

    console.log( $( this ).attr( 'id' ) );
    ord = $( this ).attr( 'id' );

    var form = $( 'form.oc' ).removeAttr( 'hidden' );

    console.log( ord );

     //  box za text i ostalo unutra okvira
     box.css( 'background-color', '#fefefe')
        .css( 'margin', 'auto')
        .css( 'padding', '20px')
        .css( 'border', '1px solid, /888')
        .css( 'width', '80%' )
        .prop( 'class', 'box')
        .append( close )
        .append( title )
        .append( form );

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

    form.on( 'submit', obradi_formu );
}

function obradi_formu(){
    event.preventDefault();

    var feedback = $( 'input[name="recenzija"]').val(),
        rating = $( 'input[name="ocjena"]').val(),
        p = $( '<p>' );
    $( this ).append( p );

    console.log( feedback, rating );
    $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/addFeedback.php',
            method: 'post',
            data:
            {
                id: ord,
                feedback: feedback,
                rating: rating
            },
            success: function( data )
            {
                if( data.hasOwnProperty( 'greska' ) ){
                    console.log( data.greska );
                    p.html( 'ERROR in database' + data.greska);
                }
                else if( data.hasOwnProperty( 'rezultat' ) ){
                    p.html( data.rezultat +' Please refresh page to see changes!');
                    console.log( data.rezultat );
                }
            },
            error: function()
            {
                console.log( 'Greška u Ajax pozivu...');
                p.html( 'ERROR in Ajax!' );

            }
        });
}
