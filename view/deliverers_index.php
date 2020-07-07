<?php require_once __DIR__ . '/header&footer/_header_deliverers.php'; ?>


<div class="col-12">
<h4>Slobodne narudžbe</h4>

<div class="avalableOrders" id="slobodne"></div>

</div>

<form action="<?php echo __SITE_URL;?>/index.php?rt=deliverers/active" method="post">
<button type="submit" name="btn_aktivna" value=" <?php echo $_SESSION['deliverers']->id;  ?>" >Aktivna</button><br>
</form>


<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>