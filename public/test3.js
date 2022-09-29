window.onload = () => {
    var b = document.getElementById("b")
var i = 0;
b.addEventListener('click',()=>{
    var data = document.createElement('input');
    data.type = "text";
    data.id = 'text' + i;
    var parent = document.getElementById("text");
    parent.after(data);
    document.getElementById("text"+( i>=1 ? i-1 : "")).style.display = "none";
    i++;
})
}