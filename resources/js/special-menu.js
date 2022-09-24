let buttons =  document.querySelectorAll('#special-menu > .button');
let views = document.querySelectorAll('.menu-view');
let menucloses = document.querySelectorAll('.Close');

for(const button of buttons){
    button.onclick = e => {
        console.log('didit')
        for(const view of views){
            view.style.display = "none";
        }
        const t = document.getElementsByClassName(e.target.id)[0];
        t.style.left = e.pageX - 10 + "px";
        t.style.top = e.pageY - 10 + "px";
        t.style.display = "";
    }
}
for(const element of menucloses){
    element.onclick = () => {
        for(const view of views){
            view.style.display = "none";
        }
    }
}
const option = document.getElementById("color_picker");

option.onchange =()=>{
    const color_indicator = document.getElementById("selected-color");

    color_indicator.style.color = option.value;
}

const prevText = document.getElementById("text");

prevText.oninput = ()=>{
    document.getElementById('selected-color').innerText = prevText.value=="" ? "preview" : prevText.value;
}

const prevURL = document.getElementById('url');

prevURL.oninput = ()=>{
    document.getElementById('url-preview').innerText = "url =>" + prevURL.value;
}