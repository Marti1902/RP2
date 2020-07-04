<?php require_once __DIR__ . '/header&footer/_header.php'; ?>
<!--
<div id="kosarica">
    <ul id = 'naruceno'>
    </ul>
    
    <div id="ukupno" style='padding: 5px;'>Ukupno: <span id="cijena">0 kn</span></div>
    <button id="odbaci">Isprazni košaricu</button>
    <button id="naruci">Naruči</button>
</div>

<div id="footer" data-position='fixed'>Nesto</div>
-->

Popis dostupnih jela:
<ul>
    <?php 
    foreach( $foodList as $food ){
        echo '<li>' .
             $food->name . ': ' . $food->price . '<br>' .
             $food->description . '<br>';
        if( $food->image_path !== null )
            echo '<img src="'. __SITE_URL . $food->image_path .'"width="100" height="100"><br>';
        echo '<button class="dodaj" id="' . $food->id_food . ', ' . $food->name . ', ' . $food->price . '">Dodaj u košaricu</button></li>';
    }
    ?>
</ul>

Recenzije:
<ul>
    <?php 
    $i=0;
    foreach( $orderList as $order ){
        echo '<li>' .
             $order->id_user . ': ' . $order->rating . '<br>' .
             '<div id="ovaj' . $i . '">' . $order->feedback . '</div><br>' .
            '</li>';
        $i++;
    } ?>
</ul>

<script>
$( document ).ready( function() 
{
    var i = 0;
    var n = <?php echo $i; ?>;
    for ( i = 0; i < n;  i++){
        var text = $( '#ovaj' + i ).html();
        var char_limit = 50;

        if(text.length < char_limit)
            $( '#ovaj' + i ).html( text );
        else
            $( '#ovaj' + i ).html( '<span class="short-text">' + text.substr(0, char_limit) + '</span><span class="long-text" style="display:none">' + text.substr(char_limit) + '</span><span class="text-dots">...</span><span class="show-more-button" data-more="0" style="color:blue">Read More</span>' );
    }


    $(".show-more-button").on('click', function() {
	// If text is shown less, then show complete
	if($(this).attr('data-more') == 0) {
		$(this).attr('data-more', 1);
		$(this).css('display', 'block');
		$(this).text('Read Less');

		$(this).prev().css('display', 'none');
		$(this).prev().prev().css('display', 'inline');
	}
	// If text is shown complete, then show less
	else if(this.getAttribute('data-more') == 1) {
		$(this).attr('data-more', 0);
		$(this).css('display', 'inline');
		$(this).text('Read More');

		$(this).prev().css('display', 'inline');
		$(this).prev().prev().css('display', 'none');
	}
    });
} );
</script>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>