<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchFavicon extends Command
{
    protected $signature = 'favicon:fetch';

    protected $description = 'Fetches and saves favicon from URL';

    public function handle()
    {
        $url = 'https://images.app.goo.gl/bucy3oK9ALAfsmvAA';
        $response = Http::get($url);

        if ($response->ok()) {
            $image = $response->body();
            Storage::disk('public')->put('favicon.png', $image);
            $this->info('Favicon fetched and saved successfully.');
        } else {
            $this->error('Failed to fetch favicon.');
        }
    }
}
