<?php require_once __DIR__ . '/header&footer/_header.php'; ?>

<form action="<?php echo __SITE_URL;?>/index.php?rt=user/searchNeighborhood" method="post">
    Odaberite kvart:
    <input type="text" list="datalist_kvartova" id="txt_kvart" name="kvart">
    <datalist id="datalist_kvartova"></datalist>
    <button type="submit">Pretraži</button>
</form>

<?php require_once __DIR__ . '/header&footer/_footer.php'; ?>