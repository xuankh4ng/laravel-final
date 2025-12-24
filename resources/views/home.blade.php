@guest
    <h1>Guest</h1>
@endguest

@auth
    <h1>{{ auth()->user()->full_name }}</h1>
@endauth
