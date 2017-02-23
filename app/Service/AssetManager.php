<?php

namespace App\Service;

class AssetManager
{
    public function load(string $url)
    {
        return '/resources/Assets/'.$url;
    }
}