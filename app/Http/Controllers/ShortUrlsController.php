<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShortUrlService;
use Illuminate\Support\Facades\Validator;

class ShortUrlsController extends Controller
{
    public function index(Request $request, ShortUrlService $shortUrlService){
        $response = [];
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|active_url'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first('url');
            return json_encode([
                'error' => $errorMessage
            ]);
        }

        $url = $request->post('url');
        $response['test'] = $shortUrlService->generateShortUrl($url);

        return json_encode($response);
    }
}