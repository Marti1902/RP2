var timestamp = 0; 

$(document).ready(function()
{
    //if($( 'h4').first().html() !== 'Slobodne narudžbe' )
    getActiveOrders();
});

function getActiveOrders()
{
    console.log(timestamp);
    //console.log( $( 'div.activeOrders' ).attr( 'id_restaurant' ) );
    $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/deliverersActiveOrders.php',
            method: 'get',
            data: 
            {
                timestamp: timestamp
            },
            success: function( data )
            {
                if( data.hasOwnProperty( 'greska' ) ){
                    console.log( data.greska );
                    p.html( 'ERROR in database' + data.greska);
                }
                else if( data.hasOwnProperty( 'nema' ) ){
                    var div = $( 'div.avalableOrders' ), p = $( '<p>' ).html( 'Trenutno nemate slobodnih narudžbi!');
                    div.append(p);
                }
                else{
                    timestamp = data.timestamp;

                    var div = $( 'div.avalableOrders' ), tbl = $( '<table>' ), tr_head = $( '<thead>' ), tbody= $('<tbody>');
                
                    tr_head.html( '<tr><th>Broj narudžbe</th><th>Restoran</th><th>Klijent</th><th>Adresa</th><th>Sadržaj narudžbe</th><th>Ukupno</th><th>Popust</th><th>Napomena</th><th></th></tr>' );
                    tbl.append( tr_head)
                        .prop('class', 'table table-hover');
                    
                    
                    for( var i = 0; i < data.id_order.length; ++i )
                    {
                        var tr = $( '<tr>' );
                        var td_id_order = $( '<td>' ).html( '<a href="index.php?rt=deliverers/order&id_order=' + data.id_order[i] + '">' + data.id_order[i] + '</a>' );
                        var td_restaurant = $( '<td>' ).html( data.restaurant[i] );
                        var td_user = $( '<td>' ).html( data.user[i] );
                        var td_address = $( '<td>' ).html( data.address[i] );
                        var td_food = $( '<td>' ).html( data.food[i] );
                        var td_price_total = $( '<td>' ).html( data.price_total[i] + ' kn');
                        var td_discount = $( '<td>' ).html( data.discount[i] );
                        var td_note = $( '<td>' ).html( data.note[i] );

                        tr.append( td_id_order )
                            .append( td_restaurant )
                            .append( td_user )
                            .append(td_address)
                            .append(td_food)
                            .append( td_price_total )
                            .append( td_discount )
                            .append( td_note )
                        tbody.append( tr );
                    }
                    tbl.append( tbody );

                    div.html( tbl );

                    getActiveOrders();
                }
            },
            error: function( xhr, status )
            {
                //console.log( status );
                if( status === 'timeout' )
                    dohvatiCijene(); 
            }
        });
}
