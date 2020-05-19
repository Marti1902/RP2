$( document ).ready( function()
{
    $( 'button.editFood' ).on('click', show_form );
    $( 'button.removeFood' ).on( 'click', show_form );

    // Obrada formi
    $( 'form.editFood').on( 'submit', obradi_editFood );
    $( 'form.removeFood').on( 'submit', obradi_removeFood );

    
    // za editFood  prati checkboxove i otključava ih
    $( '#che1' ).on('click', sakrij_pokazi);
    $( '#che2' ).on('click', sakrij_pokazi);
    $( '#che3' ).on('click', sakrij_pokazi);
    $( '#che4' ).on('click', sakrij_pokazi);
    //  Za removeFood otključava submit
    $( 'input.removeFood:checkbox' ).on('click', sakrij_pokazi_submit );




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

    addCorrectForm( box, $(this).attr('class') );

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
    else if( title === 'removeFood' ){
        var form = $( 'form.removeFood' ).removeAttr( 'hidden' );
        box.append( form );
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

function sakrij_pokazi_submit()
{
    if( $( 'input.removeFood:checkbox:checked' ).length === 0)
        $( 'input[type="submit"][value="Remove selected food"]').prop( 'disabled', true);
    else
        $( 'input[type="submit"][value="Remove selected food"]').removeAttr( 'disabled' );
}

function obradi_removeFood()
{
    var p = $( '<p>' ), checkboxes = $( 'input.removeFood:checkbox:checked' );

    event.preventDefault();
    $( this ).after( p );

    if( checkboxes.length === 0 )
    {
        p.html( 'No food selected! Please select al least 1 food item from offering.' );
        return;
    }
    console.log( checkboxes );

    $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/removeFood.php',
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
            method: 'post',
            data:
            {
                id: $( 'select.editFood option:selected' ).val(),
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