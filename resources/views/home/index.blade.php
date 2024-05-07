@include('templates.header', [
    'title' => $title,
    'menu' => $menu,
])

<p>Сортировать:</p>
<nav>
    <ul>
        <li><a href="{{ route('photo.created') }}">По дате создания</a></li>
        <li><a href="{{ route('photo.name') }}">По названию</a></li>
    </ul>
</nav>

<div class="py-10">
    <ul>
        @foreach ($photos as $photo)
            <li class="py-2">

                <div class="py-2">
                    <a href="/uploads/{{ $photo['file_name'] }}">
                        <img src="/uploads/{{ $photo['file_name'] }}" width="30" class="user-img rounded-circle mr-2 "
                            style="float: left; border-radius: 10%; border: 1px #cfc solid; box-shadow: 0 0 10px #444;" />
                    </a>

                </div>
                <a href="{{ route('photo.show', $photo['id']) }}">
                    <p>
                        {{ call_user_func($cutString, (string) $photo['file_name'], 25) }}
                    </p>
                    <p>
                        {{ call_user_func($cutString, (string) $photo['uploaded_at'], 33) }}
                    </p>
                </a>
                <a href="{{ route('zip', ['sourceFile' => "uploads/{$photo['file_name']}", 'zipFilePath' => 'uploads/archive.zip']) }}
                    "method="POST"
                    class="inline-block focus:outline-none font-bold py-2 rounded" role="button">
                    Скачать
                </a>
            </li>
        @endforeach
    </ul>
</div>

{{ $photos->links() }}
@include('templates.footer')
