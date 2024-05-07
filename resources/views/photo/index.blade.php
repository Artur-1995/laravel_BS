@include('templates.header', [
    'title' => $title,
    'menu' => $menu,
])

@include('templates.photo', ['photo' => $photo, 'user' => $user])
@include('templates.footer')
