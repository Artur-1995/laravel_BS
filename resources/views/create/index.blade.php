@include('templates.header', ['title' => $title])
@if ($message == 'Файлы успешно загружены!')
    @include('templates.messages.successful_message', ['message' => $message]);
    <a href="{{ route('upload.create') }}"
        class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded"
        role="button">
        Загрузить еще
    </a>
@else
    @if ($message)
        @include('templates.messages.error_message', ['message' => $message]);
    @endif
    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <?php $i = 0; ?>
        @while ($i != 5)
            <div class="py-1">
                <input type="file" name="files[]" multiple>
            </div>
            <?php $i++; ?>
        @endwhile
        <button type="submit"
            class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded"
            role="button">Загрузить</button>
    </form>
@endif
@include('templates.footer')
