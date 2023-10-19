<?php

namespace App\Helpers;

class YoutubeHelper
{
    public static function embedYouTubeVideo($url)
    {
        $videoId = self::getYouTubeVideoId($url);

        if ($videoId) {
            return "<iframe src=\"https://www.youtube.com/embed/{$videoId}\" frameborder=\"0\" height=\"350px\" width=\"100%\"></iframe>";
        }

        return '';
    }

    public static function getYouTubeVideoId($url)
    {
        // Parsing URL YouTube
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $query);
            if (isset($query['v'])) {
                return $query['v'];
            }
        }
        return null;
    }
}
