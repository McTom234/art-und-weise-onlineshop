<?php
    $lastPageLink = '';
    $nextPageLink = '';
    $reload = false;

    if (isset($request['page'])):
        $page = $request['page'];

        if ($page == 0) {
            $page = 1;
            $reload = true;
        }

        if ($page > $maxPages) {
            $page = $maxPages;
            $reload = true;
        }

        if ($maxPages == 0) $reload = false;

        if ($page > 1) {
            $lastPageLink .= '?p=' . ($page - 1);
            $nextPageLink .= '?p=' . ($page + 1);

            if (isset($request['query'])) {
                $nextPageLink .= '&q=' . $request['query'];
                $lastPageLink .= '&q=' . $request['query'];
            }
        }
        else {
            $nextPageLink .= '?p=' . ($page + 1);

            if (isset($request['query'])) $nextPageLink .= '&q=' . $request['query'];
        }

        if ($reload) header("Location: ?p=1&q=".$request['query']);
?>
        <div class="page-navigation">
            <a href="<?= htmlspecialchars($lastPageLink) ?>" <?php if (1 >= $page) echo 'class="inactive"'; ?>>&lt;</a>

            <span>Seite <?= htmlspecialchars($page) ?> von <?= htmlspecialchars($maxPages) ?></span>

            <a href="<?= htmlspecialchars($nextPageLink) ?>" <?php if ($maxPages <= $page) echo 'class="inactive"'; ?>>&gt;</a>
        </div>
    <?php endif; ?>
