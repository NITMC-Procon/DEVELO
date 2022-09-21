window.showLength = function(str,resultid){
    document.getElementById(resultid).innerText = str.length;
}

if(document.getElementById('date').value === ""){
    document.getElementById('date').value = Date.now();
}

window.onbeforeunload = () => {
    return "保存されていません"
}



window.addImg = function(){

    const target = document.getElementById('add-img');
    const withimg = document.getElementById('with-image');
    const withoutimg = document.getElementById('without-image');


    if(target.value === "img"){
        withimg.style.display = "block";
        withoutimg.style.display = "none";
        target.innerText = "特殊なテキストの入力";
        target.value = "text"
    }
    else{
        withimg.style.display = "none";
        withoutimg.style.display = "block";
        target.innerText = "画像の追加";
        target.value = "img"
    }
}


const option = document.getElementById("color_picker");

option.onchange =()=>{
    const color_indicator = document.getElementById("selected-color");

    color_indicator.style.color = option.value;
}

const prevText = document.getElementById("text");

prevText.oninput = ()=>{
    document.getElementById('selected-color').innerText = prevText.value;
}

const prevURL = document.getElementById('url');

prevURL.oninput = ()=>{
    document.getElementById('url-preview').innerText = "url =>" + prevURL.value;
}


let count = 0;
document.getElementById('menu-submit').onclick = ()=>{

    const target = document.getElementById('add-img');
    var intro = document.getElementById('intro-text');
    var adding = "";

    if(target.value == "img"){
        let text = document.getElementById("text").value;
        let color = document.getElementById("selected-color").style.color;
        let url = document.getElementById('url').value;

        color = color.match(/([0-9]+)/g);
        
        if(!(text==="" && color===null && url==="")){
            adding = "/-"+
                (text != "" ? "text:" + text + ":text " : "")+
                (color != null ? "color:#" + (color[0] == "0" ? "00" : Number(color[0]).toString(16)) + (color[1] == "0" ? "00" : Number(color[1]).toString(16)) + (color[2] == "0" ? "00" : Number(color[2]).toString(16)) + ":color " : "")+
                (url != "" ? "url:" + url + ":url " : "")
                +"-/";

            intro.value = intro.value.substring(0,intro.selectionStart)
            + adding
            + intro.value.substring(intro.selectionStart);

            document.getElementById("selected-color").innerHTML = "preview";
            document.getElementById("selected-color").style = "";
            document.getElementById("url-preview").innerHTML = "";
        }
    }
    else{
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
                    adding = "/-"+
                    "img:"+ file.files[0]["name"] +":img "+
                    (alt.value != "" ? "text:" + alt.value + ":text " : "")
                    +"-/";

                    intro.value = intro.value.substring(0,intro.selectionStart)
                    + adding
                    + intro.value.substring(intro.selectionStart);
                }
            })


            file.remove();
            let newImg = document.createElement('input')
            newImg.type = "file";
            newImg.id = "img";
            newImg.name = "img";
            document.getElementById('img-area').appendChild(newImg);

            
        }
    }
    console.log('done');

}

document.getElementById('form-submit').onclick = () => {
    window.onbeforeunload = null;
    let intro = document.getElementById('intro-text').value;
    if(intro == null)intro = "";
    let f = new FormData();
    let file = document.getElementById('project-icon');
    if(file.files.length != 0){
        f.append('img',file.files[0]);
        f.append('referenced',document.getElementById('date').value);
        fetch('/manage/upload-img',{
            method:'POST',
            headers:{'X-CSRF-Token':document.getElementsByName('csrf-token').item(0).content},
            body:f
        })
    }
}


document.getElementById('text-preview').onclick = ()=>{
    let f = new FormData();
    f.append('intro',document.getElementById('intro-text').value);
    f.append('referenced',document.getElementById('date').value);

    fetch('/manage/preview-in-creating',{
        method:'POST',
            headers:{'X-CSRF-Token':document.getElementsByName('csrf-token').item(0).content},
            body:f
    }).then(response => {
        if(response.ok){
            return response.json()
        }
    })
    .then(res => {
        document.getElementById('preview').innerHTML = res['intro'];
        sendtimer = Date.now();
    }).catch(error => {
        
    })
}

