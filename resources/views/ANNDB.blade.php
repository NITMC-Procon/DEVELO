<form action="">
    @csrf <!--これ書いといかんとバグ？るかもって。-->
    <input type="text" name="name" placeholder="What's your name?" required>
    <input type="text" name="age" placeholder="How old are you?" required>
    <input type="text" name="any" placeholder="コメントしてね" required>

    <input type="submit">
</form>