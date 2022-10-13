window.showLength = function(str,resultid){
    document.getElementById(resultid).innerText = str.length;
}

if(document.getElementById('date').value === ""){
    document.getElementById('date').value = Date.now();
}

window.onbeforeunload = () => {
    return "保存されていません"
}




document.getElementById('form-submit').onclick = () => {
    window.onbeforeunload = null;
    let intro = document.getElementById('intro-text').value;
    if(intro == null)intro = "";
}


document.getElementById('text-preview').onclick = ()=>{
    let f = new FormData(main_forms);
    f.append('referenced',document.getElementById('date').value);

    fetch('/manage/view',{
        method:'POST',
            headers:{'X-CSRF-Token':document.getElementsByName('csrf-token').item(0).content},
            body:f
    }).then(response => {
        if(response.ok){
            return response.json()
        }
    })
    .then(res => {
        console.log(res['view']);
        document.getElementById('preview').innerHTML = res['view'];
    }).catch(error => {
        
    })
}

