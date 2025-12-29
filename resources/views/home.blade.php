@guest
    <h1>Guest</h1>
    <a href="{{ route('login') }}">Login</a>
@endguest

@auth
    <h1>{{ auth()->user()->full_name }}</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth
