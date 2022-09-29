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

const target_text = document.getElementById('textarea-container').firstElementChild;
document.getElementById('image-submit').onclick = () => {
    let alt = document.getElementById('alt');
    let file = document.getElementById('img');
    if(file.files.length != 0){

        let f = new FormData();
        f.append('img',file.files[0]);
        f.append('referenced',document.getElementById('date').value);

        fetch('/manage/upload-img',{
            method:'POST',
            body:f,
            headers:{'X-CSRF-Token':document.getElementsByName('csrf-token').item(0).content}
        }).then(response => response.json())
        .then(r => {
            if(r["result"] != "-1"){
                target_text.value = target_text.value.substring(0,target_text.selectionStart)
                + "/-"+
                "img:"+ file.files[0]["name"] +":img "+
                (alt.value != "" ? "text:" + alt.value + ":text " : "")
                +"-/"
                + target_text.value.substring(target_text.selectionStart);
            }
        })


        file.remove();
        let newImg = document.createElement('input')
        newImg.type = "file";
        newImg.id = "img";
        newImg.name = "img";
        document.getElementById('img-area').appendChild(newImg);

        for(const view of views){
            view.style.display = "none";
        }

        
    }
}
document.getElementById('text-submit').onclick = () => {
    let text = document.getElementById("text").value;
    let color = document.getElementById("selected-color").style.color;
    let url = document.getElementById('url').value;

    color = color.match(/([0-9]+)/g);
    
    if(!(text==="" && color===null && url==="")){

        target_text.value = target_text.value.substring(0,target_text.selectionStart)
        + "/-"+
        (text != "" ? "text:" + text + ":text " : "")+
        (color != null ? "color:#" + (color[0] == "0" ? "00" : Number(color[0]).toString(16)) + (color[1] == "0" ? "00" : Number(color[1]).toString(16)) + (color[2] == "0" ? "00" : Number(color[2]).toString(16)) + ":color " : "")+
        (url != "" ? "url:" + url + ":url " : "")
        +"-/"
        + target_text.value.substring(target_text.selectionStart);

        document.getElementById("selected-color").innerHTML = "preview";
        document.getElementById("selected-color").style = "";
        document.getElementById("url-preview").innerHTML = "";

        for(const view of views){
            view.style.display = "none";
        }
    }
}
