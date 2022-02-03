<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ProjectHelper
{
    public static function getVideoProjectThumbnailUrl(string $videoUrl): string
    {
        $videoId = str_replace("https://youtu.be/", "", $videoUrl);

        $thumbnailResolutions = ["maxresdefault", "sddefault", "hqdefault", "mqdefault", "default"];

        foreach ($thumbnailResolutions as $resolution) {
            $imageUrl = "http://i.ytimg.com/vi/$videoId/$resolution.jpg";

            $response = Http::get($imageUrl);

            if ($response->status() === 200) {
                return str_replace("http", "https", $imageUrl);
            }
        }

        return null;
    }

    public static function getVideoProjectEmbeddedUrl(string $videoUrl): string
    {
        return str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $videoUrl);
    }

    public static function getGitHubProjectEmbeddedUrl(string $gitHubUrl): string
    {
        return str_replace("https://github.com/", "https://combinatronics.com/", $gitHubUrl) . "/master/index.html";
    }
}
