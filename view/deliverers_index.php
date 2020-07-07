<?php require_once __DIR__ . '/header&footer/_header_deliverers.php'; ?>

<!--            NOTIFIKACIJA            -->
<div style="position: relative;" >
<div class="toast" data-autohide="true"  style="  background-color: #DCDCDC; position: absolute; top: 0; right: 10px;">
    <div class="toast-header">
      Narudžba prihvaćena
    </div>
    <div class="toast-body">
      Pogledajte aktivne narudžbe za detalje.
    </div>
</div>
</div>

<div class="col-12">
<h4>Slobodne narudžbe</h4>

<div class="avalableOrders" id="slobodne" id_deliverer="<?php echo $_SESSION['deliverers']->id;?>"></div>

</div>

<form action="<?php echo __SITE_URL;?>/index.php?rt=deliverers/active" method="post">
<button type="submit" name="btn_aktivna" value=" <?php echo $_SESSION['deliverers']->id;  ?>" >Aktivna</button><br>
</form>


<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>