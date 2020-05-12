<?php require_once __DIR__ . '/_header.php'; ?>

Popis dostupnih jela:
<ul>
    <?php 
    foreach( $foodList as $food ){
        echo '<li>' .
             $food->name . ': ' . $food->price . '<br>' .
             $food->food_type . ' ' . $food->description . '<br>' .
            '</li>';
    }
    ?>
</ul>

Recenzije:
<ul>
    <?php 
    foreach( $feedbackList as $feedback ){
        echo '<li>' .
             $feedback->id_user . ': ' . $feedback->rating . '<br>' .
             $feedback->content . '<br>' .
            '</li>';
    }
    ?>
</ul>


<?php require_once __DIR__ . '/_footer.php'; ?>