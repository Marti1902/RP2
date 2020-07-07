<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<?php echo '<span id="idjevi" id_restaurant="' . $foodList[0]->id_restaurant . '" id_user="' . $_SESSION['user']->id . '" hidden></span>'; ?>
<?php echo '<span id="gl_adresa" gl_adresa="' . $_SESSION['user']->address . '" hidden></span>'; ?>

<h5>Ocjena: <?php echo $rating; ?></h5><br><br>

<h3> Meni: </h3>

<table class="table table" name="food" >
    <thead>
    <tr>
        <th>Jelo </th>
        <th>Cijena </th>
        <th>Opis </th>
        <th>Slika </th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach( $foodList as $food)
    {

            echo "<tr id=".$food->id_food.">\n";
            echo "<td>". $food->name ."</td>\n";
            echo "<td>". $food->price . ' kn ' . "</td>\n";
            echo "<td>". $food->description ."</td>\n";
            echo "<td>";
                if( $food->image_path !== null )
                    echo '<img src="'. __SITE_URL . $food->image_path .'" width="100" height="100" name="' .$food->name. '">';
            echo "</td>\n";
            echo '<td><button img="' . $food->image_path . '" class="dodaj" id="' . $food->id_food . ', ' . $food->name . ', ' . $food->price . '">Dodaj u košaricu</button></li></td>';
            echo "</tr>\n";
    }
?>
    </tbody>
</table>

<!--
<ul>
    <?php /*
    foreach( $foodList as $food ){
        echo '<li>' .
             $food->name . ': ' . $food->price . '<br>' .
             $food->description . '<br>';
        if( $food->image_path !== null )
            echo '<img src="'. __SITE_URL . $food->image_path .'"width="100" height="100"><br>';
        echo '<button img="' . $food->image_path . '" class="dodaj" id="' . $food->id_food . ', ' . $food->name . ', ' . $food->price . '">Dodaj u košaricu</button></li>';
    }*/
    ?>
</ul> -->

<h3>Recenzije: </h3>
<ul class="list-group">
    <?php 
    $i=0;
    foreach( $orderList as $order ){
        if( $order->active == 0 ){
            echo '<li class="list-group-item">' .
                $order->id_user . ': ' . $order->rating . '<br>' .
                '<div id="ovaj' . $i . '">' . $order->feedback . '</div><br>' .
                '<button class="thumbs" id="' . $order->id_order . '" palac="gori">' . $order->thumbs_up . '</button>' . 
                '<button class="thumbs" id="' . $order->id_order . '" palac="doli">' . $order->thumbs_down . '</button>' . 
                '</li>';
            $i++;
        }
    } ?>
</ul>

<span id="povratna" hidden>Narudžba poslana restoranu. Za više detalja pogledajte <a href="<?php echo __SITE_URL; ?>/index.php?rt=user/orders">Moje narudžbe</a>.</span>

<div style="height: 250px;"> </div>

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