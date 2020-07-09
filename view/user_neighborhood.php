<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<form action="<?php echo __SITE_URL;?>/index.php?rt=user/searchNeighborhood" method="post">
    <h4>Odaberite kvart:</h4>
    <input class="form-control" type="text" list="datalist_kvartova" id="txt_kvart" name="kvart">
    <datalist id="datalist_kvartova"></datalist>
    <button class="btn btn-primary"type="submit">Pretraži</button>
</form>

<div style="height: 250px;"> </div>

</div>
</div>
</div>

<!-- <h4>Istraži više restorana:</h4> -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">   
    <ul class="nav navbar-nav">
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/popular">Popularni</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/restaurants">Svi restorani</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/neighborhood">U kvartu</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo __SITE_URL; ?>/index.php?rt=user/foodType">Prema vrsti hrane</a></li>
    </ul>
</nav> 

<!-- <div style="height: 250px;"> </div> -->

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>