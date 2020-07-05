
$( document ).ready( function()
{
    //$( 'img' ).on('click', show_galery );
    $('img').attr('galerija', '1');
    //$( 'body' ).on( 'click', 'img', show_galery );
    $( 'body' ).on( 'click', 'img[galerija="1"]', show_galery );

  //$( 'img[galerija="1"]').off('click', show_galery);

});


function show_galery(event)
{
    var div = $( '<div>' ), title = $( '<h2>' ), box = $( '<div>'), close = $( '<span>' );
    var img = $(event.target);

    title.html( img.attr('name') )
        .css( 'color', 'black' );

    // link za zatvaranje boxa i okvira
    close.html('&times')
        .css( 'color', '#aaaaaa' )
        .css( 'float', 'right' )
        .css( 'font-size', '35')
        .css( 'font-weight', 'bold')
        .attr( 'x', '1')
        .css( 'cursor', 'pointer' )
        .on( 'click', destroy_ )         //izbrise sve kreirane elemente u divu kada se klikne
        .focus(function(){          // ne , drugačije riješit
            $(this).css( 'color', 'black' )
                    .css( 'text-decoration', 'none' )
                    .css( 'cursor', 'pointer' );
        })
        .on({
            mouseenter: function () {
                $(this).css('color', 'red')
            },
            mouseleave: function () {
                $(this).css( 'color', '#aaaaaa' );
            }
        });

    
     //  box za text i ostalo unutra okvira
     box.css( 'position', 'absolute')
        .css( 'text-align', 'center')
        .css('top', '10%')
        .css('left', '10%')
        .css('height', '80%')
        .css( 'width', '80%' )
        .css( 'background-color', 'gray' )
        .css('class', 'galerija_box')
        .append( close )
        .append( title );

        //  vanjski okvir    
        div.css( 'position', 'fixed')
        .css('display', 'block')
        .css( 'text-align', 'center')
        .css('top', '0%')
        .css('left', '0%')
        .css( 'padding-top', '100px')
        .css('height', '90%')
        .css( 'width', '100%' )
        .css( 'z-index', '1')
        .css( 'background-color', 'rgba(0,0,0,0.4)' )
        .css( 'overflow', 'auto' )
        .prop( 'class', 'galerija_okvir');
        
    
    div.append(box);

    //   Zatvara prozor ako se klikne van boxa
    div.on( 'click', destroy_);

    $(this).after(div);

        
    console.log(img);
    //dodajemo sliku
    var duplicate_4show = img.clone(), koef, okvirSlike = $('<div>');
    okvirSlike.css('position', 'relative')
        .css('height', '80%')
        .css('width', '85%')
        .css( 'position', 'relative')
        .css( 'display', 'block')
        .css( 'margin', 'auto')
        .css( 'margin-left', 'auto' )
        .css( 'top', '5%' )
        .attr('okvir', '1')
        //.css( 'object-fit', 'cover')
        .css( 'margin-bottom', '10%');
    box.append(okvirSlike);

    duplicate_4show
        .css( 'object-fit', 'contain')
        //.css( 'display', 'block')
        //.css( 'margin', 'auto')
        .attr('galerija', '0')
        .show();
    //console.log(okvirSlike.height(), okvirSlike.width());        
    if( okvirSlike.height() / duplicate_4show.prop('naturalHeight') < okvirSlike.width() / duplicate_4show.prop('naturalWidth') )
        koef = okvirSlike.height() / duplicate_4show.prop('naturalHeight');
    else
        koef = okvirSlike.width() / duplicate_4show.prop('naturalWidth');
        duplicate_4show
            .css( 'height', duplicate_4show.prop('naturalHeight') * koef )
            .css( 'width', duplicate_4show.prop('naturalWidth') * koef );
    //console.log(duplicate_4show.height(), duplicate_4show.width());        
    
    duplicate_4show.attr('postavljena', '1');

    okvirSlike.append(duplicate_4show);

    $(window).on('resize', function(){
        var duplicate_4show = $('img[postavljena="1"]'), 
            okvirSlike = $('div[okvir="1"]');

            if( okvirSlike.height() / duplicate_4show.prop('naturalHeight') < okvirSlike.width() / duplicate_4show.prop('naturalWidth') )
        koef = okvirSlike.height() / duplicate_4show.prop('naturalHeight');
    else
        koef = okvirSlike.width() / duplicate_4show.prop('naturalWidth');
        duplicate_4show
            .css( 'height', duplicate_4show.prop('naturalHeight') * koef )
            .css( 'width', duplicate_4show.prop('naturalWidth') * koef );
  });

}
function destroy_(event)
{
    if( $(event.target).attr('class') === 'galerija_okvir' ||
        $(event.target).attr('x') === '1' )
        $('div.galerija_okvir').remove();
}

