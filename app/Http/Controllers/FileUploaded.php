<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UploadedFile;
use Carbon\Carbon;
use ZipArchive;

class FileUploaded extends Controller
{
    public function create($message = '')
    {
        return view('create.index', ['title' => 'Добавить пост', 'cutString' => [$this, 'cutString'], 'menu' => $this->getMenu(), 'message' => $message ?? false]);
    }

    public function upload(Request $request)
    {
        $message = '';
        $extensions = ['jpg', 'png'];

        // Проверка наличия файлов
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {

                // Проверка раширения
                if (in_array($file->getClientOriginalExtension(), $extensions)) {

                    // Проверка совпадений по названию файла
                    $uniqidFileName = UploadedFile::where('file_name', $file->getClientOriginalName())->first();
                    $filename = Str::lower(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension());

                    while ($uniqidFileName) {

                        // Генерация уникального имени файла на английском
                        $filename = Str::lower(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . uniqid() . '.' . $file->getClientOriginalExtension());
                        $uniqidFileName = UploadedFile::where('file_name', $filename)->first();
                    }

                    // Перемещение файла в директорию uploads
                    $file->move(public_path('uploads'), $filename);

                    // Сохранение информации о загруженном файле в базу данных
                    UploadedFile::create([
                        'file_name' => $filename,
                        'uploaded_at' => Carbon::now(),
                    ]);
                    $message = "Файлы успешно загружены!";

                } else {
                    $message = 'Принимаются только форматы: ' . implode(', и ', $extensions);
                }
            }

        } else {
            $message = "Файлы не были выбраны для загрузки.";
        }

        return $this->create($message);
    }
    function zip(Request $request)
    {
        $zipFilePath = $request->zipFilePath;
        $sourceFile = $request->sourceFile;
        $zip = new ZipArchive();

        // Создание файла
        touch($zipFilePath);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($sourceFile, basename($sourceFile));
            $zip->close();

            return response()->download(public_path($zipFilePath))->deleteFileAfterSend(true);
        } else {
            return "Ошибка при упаковке файла в ZIP архив.";
        }
    }
}
