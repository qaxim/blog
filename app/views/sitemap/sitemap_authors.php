﻿<?php
echo'<?xml version="1.0" encoding="UTF-8"?>';
echo'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
if ($users->num_rows > 0) { foreach($users as $user) {
$d = $post['created_at'];
$date = date('Y-m-d', strtotime($d));
echo '
<sitemap>
<loc>'.root.$user['slug'].'</loc>
<lastmod>'.$date.'</lastmod>
</sitemap>
'; }}
echo'</sitemapindex>'; ?>