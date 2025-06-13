<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadsController
{
    public const PATH = 'uploads';

    private static function getFullPath($filename): string
    {
        return sprintf('%s/%s', self::PATH, $filename);
    }

    public function upload(Request $request)
    {
        $file = $request->file;
        $filename = sprintf('%s.%s', Str::uuid(), $file->guessExtension() ?? 'unknown');
        $path = static::getFullPath($filename);
        Storage::put($path, $file->getContent());

        return response()->json(['location' => config('app.url', 'http://localhost:8082') . '/v1/' . $path]);
    }

    public function file(string $filename)
    {
        $path = static::getFullPath($filename);
        return Storage::response($path);
    }
}
