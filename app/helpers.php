<?php

function getYoutubeVideoIdFromUrl($url) {
    $videoId = '';
    $pattern = '/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^\s&]+)/';
    preg_match($pattern, $url, $matches);
    if (isset($matches[1])) {
        $videoId = $matches[1];
    }
    return $videoId;
}


