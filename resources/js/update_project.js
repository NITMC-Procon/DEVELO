window.showLength = function(str,resultid){
    document.getElementById(resultid).innerText = str.length;
}



window.addImg = function(){

    const target = document.getElementById('add-img');
    const withimg = document.getElementById('with-image');
    const withoutimg = document.getElementById('without-image');


    if(target.textContent === "add img"){
        withimg.style.display = "block";
        withoutimg.style.display = "none";
        target.innerText = "add text";
    }
    else{
        withimg.style.display = "none";
        withoutimg.style.display = "block";
        target.innerText = "add img";
    }
}

window.showColor = function(){

    const target = document.getElementById("color");
    const color_indicator = document.getElementById("selected-color");
    const option = document.getElementById("color_picker");


    if(target.value == "option"){
        option.style.display = "";
        color_indicator.style.color = option.value;
    }
    else{
        option.style.display = "none";
        color_indicator.style.color = target.value;
    }
}
const option = document.getElementById("color_picker");

option.onchange =()=>{
    const color_indicator = document.getElementById("selected-color");

    color_indicator.style.color = option.value;
}

const prevText = document.getElementById("text");

prevText.onchange = ()=>{
    document.getElementById('selected-color').innerText = prevText.value;
}

const prevURL = document.getElementById('url');

prevURL.onchange = ()=>{
    document.getElementById('url-preview').innerText = "url =>" + prevURL.value;
}


let count = 0;
document.getElementById('menu-submit').onclick = ()=>{

    const target = document.getElementById('add-img');
    var intro = document.getElementById('intro-text');
    var adding = "";

    if(target.textContent == "add img"){
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
        }
    }
    else{
        let alt = document.getElementById('alt');
        let file = document.getElementById('img');
        if(file.files.length != 0){

            let f = new FormData();
            f.append('img',file.files[0]);
            f.append('referenced',time);
            let x = new XMLHttpRequest();
            
            x.open('POST',"/upload-img",true);
            x.setRequestHeader('X-CSRF-Token',document.getElementsByName('csrf-token').item(0).content);
            x.onreadystatechange = ()=>{
                if(x.readyState == 4 && x.responseText != "[-1]"){
                    console.log(x.responseText)
                    adding = "/-"+
                    "img:"+ file.files[0]["name"] +":img "+
                    (alt.value != "" ? "text:" + alt.value + ":text " : "")
                    +"-/";

                    intro.value = intro.value.substring(0,intro.selectionStart)
                    + adding
                    + intro.value.substring(intro.selectionStart);
                }
            }
            x.send(f);

            file.remove();
            let newImg = document.createElement('input')
            newImg.type = "file";
            newImg.id = "img";
            newImg.name = "img";
            document.getElementById('img-area').appendChild(newImg);

            
        }
    }
    console.log('done')

}

document.getElementById('intro-text').oninput = ()=>{
    let f = new FormData();
    f.append('intro',document.getElementById('intro-text').value);
    f.append('referenced',time);
    let x = new XMLHttpRequest();
    
    x.open('POST','/preview-in-creating',true);
    x.setRequestHeader('X-CSRF-Token',document.getElementsByName('csrf-token').item(0).content);
    x.onreadystatechange = ()=>{
        if(x.readyState == 4){
            document.getElementById('preview').innerHTML = x.responseText;
            console.log(x.responseText);
        }
    }
    x.send(f);
}
