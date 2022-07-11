<form action="/insert" method="post">
    @csrf
    <input type="text" name="name" placeholder="name" required>
    <input type="text" name="email" placeholder="email" required>
    <input type="submit">
</form>