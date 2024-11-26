<?php

namespace App\Http\Controllers;

use App\Models\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class URLController extends Controller
{
    //

    public function index()
    {
        return view('shortener');
    }

    public function shorten(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url|max:2048'
        ]);

        try {
            $longUrl = $request->long_url;

            $url = DB::transaction(function () use ($longUrl) {
                $existingUrl = URL::where('long_url', $longUrl)->first();

                if ($existingUrl) {
                    return $existingUrl;
                }

                do {
                    $shortCode = Str::random(6);
                } while (URL::where('short_code', $shortCode)->exists());

                return URL::create([
                    'long_url' => $longUrl,
                    'short_code' => $shortCode
                ]);
            });

            return redirect()->route('shortener')->with('short_url', url($url->short_code));
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "22001") {
                return redirect()->route('shortener')->withErrors(['error' => 'The URL is too long. The maximum length is 2048 characters.']);
            }
            return redirect()->route('shortener')->withErrors(['error' => 'An unexpected database error occurred.']);
        } catch (\Exception $e) {
            return redirect()->route('shortener')->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }



    public function redirect($shortCode)
    {
        try {
            $url = cache()->remember("short_code:{$shortCode}", now()->addMinutes(10), function () use ($shortCode) {
                return URL::where('short_code', $shortCode)->first();
            });

            if (!$url) {
                abort(404, 'The short URL does not exist.');
            }

            return redirect($url->long_url);
        } catch (\Exception $e) {
            abort(500, 'An error occurred while processing your request.');
        }
    }
}
