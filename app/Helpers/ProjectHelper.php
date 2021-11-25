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
}
