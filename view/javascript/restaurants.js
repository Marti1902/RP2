$( document ).ready( function()
{
    $( 'button.editFood' ).on('click', show_form );
    //$( 'select.editFood' ).on( 'change', change_food);

    $( 'form.editFood').on( 'submit', obradi_editFood );

    $( '#che1' ).on('click', sakrij_pokazi);
    $( '#che2' ).on('click', sakrij_pokazi);
    $( '#che3' ).on('click', sakrij_pokazi);
    $( '#che4' ).on('click', sakrij_pokazi);

});

function show_form()
{
    var div = $( '<div>' ), title = $( '<h2>' ), box = $( '<div>'), close = $( '<span>' );

    //ostale buttone zaključamo - nemožemo imat više otvorenih prozora
    //$( 'button' ).prop( 'disabled', 'true');

    title.html( $(this).attr('title') )
        .css( 'color', 'black' );

    // link za zatvaranje boxa i okvira
    close.html('&times')
        .css( 'color', '#aaaaaa' )
        .css( 'float', 'right' )
        .css( 'font-size', '35')
        .css( 'font-weight', 'bold')
        .on( 'click', function(event){
            destroy($(event.target));
        })         //izbrise sve kreirane elemente u divu kada se klikne
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
        .append( title );

    addCorrectForm( box, $(this).attr('class'), $(this).attr('target') );

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
    div.on( 'click', function(event){
            if( $(event.target).attr('class') === 'okvir' )
                destroy( $(event.target) );
        });


        $(this).after(div);
}

function addCorrectForm( box,title, path)
{
    if( title === 'editFood'){
        var table = $( 'table.food' ).clone();
        //subTitle
        box.append( table );              // Prikaz trenutne hrane u ponudi
        addEditForm(box);
    }
}



function addEditForm(box)
{
    var form = $( 'form.editFood' ), select = $( 'select.editFood' );

    form.removeAttr('hidden');
    box.append(form);
}

function sakrij_pokazi(event)
{
    var input = $( 'input[type="text"][name="'+ $(event.target).attr('name')+'"]');
    if( input.length === 0)
        input = $( 'input[type="number"][name="'+ $(event.target).attr('name')+'"]');

    
    if( typeof input.attr('disabled') !== typeof undefined && input.attr('disabled') !== false )
        input.removeAttr( 'disabled' );
    else{
        input.prop( 'disabled', true);
        input.val('');
    }
}

function obradi_editFood(event)
{
    event.preventDefault();

    var name = $( 'input[type="text"][name="foodName"]').val(),
        price = $( 'input[type="number"][name="foodPrice"]').val(),
        description = $( 'input[type="text"][name="foodDescription"]').val(),
        time =  $( 'input[type="number"][name="foodWaitingTime"]').val(),
        p = $( '<p>' );

    $(this).append(p);

    $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/editFood.php',
            method: 'get',
            data:
            {
                id: id,
                name: name,
                price: price,
                description: description,
                waitingTime: time
            },
            success: function( data )
            {
                if( data.hasOwnProperty( 'greska' ) )
                    console.log( data.greska );
                else if( data.hasOwnProperty( 'rezultat' ) ){
                    p.html( data.rezultat +' Please refresh page to see changes!');
                    console.log( data.rezultat );
                }

            },
            error: function()
            {
                console.log( 'Greška u Ajax pozivu...');
            }
        });

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