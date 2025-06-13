<?php

namespace App\Services;

use App\Models\TrackEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrackService
{
    public function track(Request $request)
    {
        $entries = collect($request->input('entries'))->map(function ($entry) { $entry['date'] = Carbon::parse($entry['date']); return $entry; });
        Log::info($entries);
        TrackEntry::insert($entries->all());
    }
}