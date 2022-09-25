console.log('ok');
let synchroBtns = document.querySelectorAll('.synchroBtn');
let synchros = document.querySelectorAll('.synchro');
let closes = document.querySelectorAll('.synchroClose');
let titles = document.querySelectorAll('.menu-title');
for(const element of synchroBtns){
    console.log('did')
    element.onclick = e => {
        for(const synchro of synchros){
            synchro.style.display = "none";
        }
        const t = document.getElementsByClassName(e.target.id)[0];
        const judge = e.pageX > document.body.clientWidth/2;
        const isAbsolute = t.classList.contains('absolute');
        for(const element of closes){
            element.style.left = judge ? "19rem" : "0px";
        }
        console.log(window.scrollY + element.parentElement.getBoundingClientRect().top,e.pageY);
        t.style.left = e.pageX - 10 - ( isAbsolute ? window.scrollX + element.parentElement.getBoundingClientRect().left : 0) + "px";
        t.style.top = e.pageY - 10 - ( isAbsolute ? window.scrollY + element.parentElement.getBoundingClientRect().top - 20 : 0) + "px";
        t.style.transform = "translate(" + (judge ? "-19rem" : "0px") + ",0)";
        t.style.display = "";
    }
}
for(const element of closes){
    element.onclick = () => {
        for(const synchro of synchros){
            synchro.style.display = "none"
        }
    }
}
for(const title of titles){
    title.style.fontSize = title.innerText.length > 10 ? "100%" : "";
}
    
