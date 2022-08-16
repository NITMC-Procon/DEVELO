<form method="POST" action="{{ route('logout') }}">
    @csrf
    <input type="submit" value="logout">
</form>