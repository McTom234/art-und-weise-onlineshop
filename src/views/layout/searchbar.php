<form class="searchbar">
    <label class="label-placeholder">Suche:</label>
    <input id="searchbar" type="text" name="q" placeholder=" "
        <?php if (isset($_GET['q'])) { echo 'value="'.$_GET['q'].'"'; } ?>
    >
    <label for="searchbar">Suche:</label>
    <button type="submit">Suchen!</button>
</form>
