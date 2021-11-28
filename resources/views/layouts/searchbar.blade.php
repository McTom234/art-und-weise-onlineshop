<form class="searchbar">
    <input id="searchbar" type="text" name="q" value="@isset($query){{$query}}@endif">
    <label for="searchbar">Suche:</label>
    <button type="submit">Suchen!</button>
</form>
