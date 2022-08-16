window.showLength = function(str,resultid){
    document.getElementById(resultid).innerText = str.length;
}

window.addEventListener("load",function(){

    const intro = document.getElementsByClassName('intro');

    intro.addEventListener('mouseover',function(){


    })
})

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

    
}