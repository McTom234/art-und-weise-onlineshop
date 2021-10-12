<form class="searchbar">
    <?php if (isset($_GET['c'])): ?>
        <label style="display: none;">
            <input type="text" name="c" value="<?=$_GET['c']?>"/>
        </label>
    <?php endif; ?>

    <input id="searchbar" type="text" name="q" placeholder=" "
<?php
        if (isset($_GET['q'])) {
            echo 'value="' . htmlspecialchars($_GET['q']) . '"';
        }
?>
    >
    <label for="searchbar">Suche:</label>

    <button type="submit">Suchen!</button>
</form>
