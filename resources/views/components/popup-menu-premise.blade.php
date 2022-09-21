<script type="text/javascript">
    console.log('ok');
    let synchroBtns = document.querySelectorAll('.synchroBtn');
    let synchros = document.querySelectorAll('.synchro');
    let closes = document.querySelectorAll('.synchroClose')
    let titles = document.querySelectorAll('.menu-title')
    let opened = false;
    for(const element of synchroBtns){
        console.log('did')
        element.onclick = e => {
            for(const synchro of synchros){
                synchro.style.display = "none"
            }
            const t = document.getElementsByClassName(e.target.id)[0].style;
            t.left = e.pageX-10 + "px";
            t.top = e.pageY-10 + "px";
            t.display = "";
            opened = true;
            console.log("didit")
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
    
</script>