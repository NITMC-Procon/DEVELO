<form action="/DBtest" method="POST"> <!--actionがURL指定的なの、method="POST"は何かデータを送るためのページですよと指定する奴-->
    @csrf <!--これ書いといかんとバグ？るかもって。-->
    <input type="text" name="name" placeholder="What's your name?" required>
    <input type="text" name="age" placeholder="How old are you?" required>
    <input type="text" name="any" placeholder="コメントしてね" required><!-- typeは何を入力するか？nameはテーブル上の何というカラムにデータを送るか、placeholderは何も入力されてないときに表示する奴、requiredは未入力じゃ受け付けませんって奴-->

    <input type="submit">
</form>