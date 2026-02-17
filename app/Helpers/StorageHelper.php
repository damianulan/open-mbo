<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageHelper
{
    public static function getImageUrl(string $storagePath, array $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg']): ?string
    {
        $url = null;
        foreach ($allowed_extensions as $ext) {
            $fullpath = $storagePath . '.' . $ext;
            if (Storage::fileExists($fullpath)) {
                if ('svg' === $ext) {
                    $url = Storage::get($fullpath);
                }
                $url = Storage::url($fullpath);
                break;
            }
        }

        return $url;
    }

    public static function getUploadedImageUrl(string $storagePath, array $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg']): ?string
    {
        return self::getImageUrl('uploads/' . $storagePath, $allowed_extensions);
    }

    public static function getImageHtml(string $storagePath, array $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'])
    {
        $output = '';
        $url = self::getImageUrl($storagePath, $allowed_extensions);
        if ($url) {
            $output = <<<HTML
                <img class="w-100" src="{$url}"/>'
                HTML;
        }

        return $output;
    }

    public static function getBrandingHtml(): ?string
    {
        $filepath = settings('general.site_logo');
        $image = null;
        $type = null;

        if ($filepath) {
            if (Storage::fileExists($filepath)) {
                $image = Storage::get($filepath);
                $type = self::isSvg($image) ? 'svg' : 'image';
                if ('svg' !== $type) {
                    $image = Storage::url($filepath);
                }
            }
        }
        $sitename = sitename();
        $url = url('/');

        $content = match ($type) {
            'svg' => $image,
            'image' => <<<HTML
                <img class="w-100" src="{$image}"/>
                HTML,
            default => <<<HTML
                <div class="brand-icon"><i class="bi-bullseye"></i></div>
                <div class="brand-title">{$sitename}</div>
            HTML
        };

        return <<<HTML
            <div class="d-flex">
                <a class="brand" href="{$url}">
                    {$content}
                </a>
            </div>
        HTML;
    }

    public static function isSvg(string $contents): bool
    {
        return Str::contains($contents, '<svg', true);
    }
}
