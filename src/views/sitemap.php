<?php

echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <?php
    /** @var \qwestern\easyii\menu\models\Url $url */
    foreach($urls as $url): ?>
        <url>
            <loc><?= $url->toString(true) ?></loc>
            <changefreq>weekly</changefreq>
            <?php if(!empty($url->getUpdatedAt())): ?>
                <lastmod><?= $url->getUpdatedAt() ?></lastmod>
            <?php endif; ?>
        </url>
    <?php endforeach; ?>


</urlset>