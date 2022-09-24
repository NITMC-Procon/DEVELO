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
        const p = t.parentElement;
        t.style.left = (p.style.position == "absolute" ? 0 : e.pageX) - 10 + "px";
        t.style.top = (p.style.position == "absolute" ? 0 : e.pageY) - 10 + "px";
        t.style.display = "";
        console.log(t.parentElement.style.position);
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
    
