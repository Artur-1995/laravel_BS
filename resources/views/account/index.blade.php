@include('templates.header', [
    'title' => $title,
    'menu' => $menu,
])


<a href="{{ route('user.getToken', ['userId' => $user['id']]) }}"
    class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded"
    role="button">
    Получить Api Token
</a>


<?php
$hiddenText = $user['api_token'];
?>

@if ($user['api_token'])
    <button class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded"
        role="button" onclick="copyToken('{{ $user['api_token'] }}')">Копировать токен</button>
    <a href="{{ route('user.setToken', ['userId' => $user['id']]) }}"
        class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded"
        role="button">
        Удалить Api Token
    </a>
    <div class="py-3">

        <p>Ваш токен:</p>
        <p id="hiddenText">{{ $user['api_token'] }}</p>
    </div>
@endif

<!-- Подключение jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function copyToken(token) {
        var hiddenText = token;

        var $tmp = $("<textarea>");
        $("body").append($tmp);
        $tmp.val(hiddenText).select();
        document.execCommand("copy");
        $tmp.remove();

        alert("Токен скопирован: " + hiddenText);
    }
</script>
@include('templates.footer')
