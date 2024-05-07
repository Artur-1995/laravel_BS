<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UploadedFile;

class PhotoController extends Controller
{
    public function show(Request $request, ...$photoId)
    {
        $answer = User::where('api_token', $request->token)->first();

        if ($answer) {

            if ($photoId) {
                $photo = UploadedFile::where($photoId);

                return response()->json(['data' => $photo], 200);

            } else {
                $photos = UploadedFile::all();

                return response()->json(['data' => $photos], 200);
            }
        }
        abort(401, 'Токен не найден!');
    }
}
