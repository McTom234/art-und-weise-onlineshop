<form class="searchbar">
    <?php if (isset($_GET['c'])): ?>
        <label>
            <input style="display: none" type="text" name="c" value="<?=$_GET['c']?>"/>
        </label>
    <?php endif; ?>
    <input id="searchbar" type="text" name="q" placeholder=" "
        <?php if (isset($_GET['q'])) {
            echo 'value="' . $_GET['q'] . '"';
        } ?>
    >
    <label for="searchbar">Suche:</label>
    <button type="submit">Suchen!</button>
</form>
