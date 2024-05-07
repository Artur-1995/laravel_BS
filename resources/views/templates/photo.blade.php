<div class="container top-bar" id="photo-container">
    <div class="bar-line">
        <div style="width: 20%; float:left">
            <a href="/uploads/{{ $photo['file_name'] }}">
                <img src="/uploads/{{ $photo['file_name'] }}" width="200"
                    style="float: left; border-radius: 10%; border: 1px #cfc solid; box-shadow: 0 0 10px #444;" />
            </a>
        </div>
        <div style="width: 80%; float:right">
            <p class="photo-uploaded_at">{{ $photo['file_name'] }}</p>
            <p class="photo-uploaded_at">Дата и время загрузки: {{ $photo['uploaded_at'] }}</p>
        </div>
    </div>
    <a href="{{ route('zip', ['sourceFile' => "uploads/{$photo['file_name']}", 'zipFilePath' => 'uploads/archive.zip']) }}
    "method="POST"
        class="inline-block focus:outline-none font-bold py-2 rounded" role="button">
        Скачать
    </a>
</div>
