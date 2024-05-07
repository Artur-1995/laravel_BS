<?php

namespace App\Http\Controllers;

use App\Models\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index($photos = [], $count = 4)
    {
        $user = Auth::user() ?? '';
        if ($user) {
            $photos = $photos ? $photos->paginate($count) : UploadedFile::paginate($count);
            return view('home.index', ['title' => 'Изображения', 'cutString' => [$this, 'cutString'], 'menu' => $this->getMenu(), 'photos' => $photos, 'user' => $user]);
        }
        return redirect()->route('login');
    }
    public function show($photoId, ...$user)
    {
        $photo = UploadedFile::find($photoId);
        $user = Auth::user() ?? '';

        return view('photo.index', ['title' => 'Просмотр изображения', 'cutString' => [$this, 'cutString'], 'menu' => $this->getMenu(), 'photo' => $photo, 'user' => $user]);
    }
    public function name()
    {
        $photos = UploadedFile::orderByDesc('file_name');
        return $this->index($photos);
    }
    public function created()
    {
        $photos = UploadedFile::orderByDesc('uploaded_at');
        return $this->index($photos);
    }
}
