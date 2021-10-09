<?php

$lastPageLink = '';
$nextPageLink = '';
if (isset($request['page'])):
    $page = $request['page'];
    if ($page > 1) {
        $lastPageLink .= '?p=' . ($page - 1);
        $nextPageLink .= '?p=' . ($page + 1);
        if (isset($request['query'])) {
            $nextPageLink .= '&q=' . $request['query'];
            $lastPageLink .= '&q=' . $request['query'];
        }
    } else {
        $nextPageLink .= '?p=' . ($page + 1);
        if (isset($request['query'])) $nextPageLink .= '&q=' . $request['query'];
    }
    ?>
    <a href="<?= $lastPageLink ?>"><</a>
    <span>Seite <?= $page ?> von <?= $maxPages ?></span>
    <a href="<?= $nextPageLink ?>">></a>
<?php endif; ?>
