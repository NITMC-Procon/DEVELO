const m = document.querySelector("#m").innerText;

for(const element of document.querySelectorAll('.ans')){
    element.oninput = () => {
        document.querySelector("#c").innerText = counting();
    }
}

function counting(){
    let r = 0;
    for(const element of document.querySelectorAll('.ans')){
        if(element.value)r++; 
    }
    return r;
}

document.querySelector('#submit').onclick = () => {
    if(counting() == m){
        document.forms.submit();
    }
}