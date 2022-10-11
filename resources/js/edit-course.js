let c = 0;

document.querySelector('#select-quantity').onchange = () => {
    let target = document.querySelector('#select-quantity').value;
    const other = document.querySelector('#other').checked;
    let parent = document.querySelector('#question-edit')

    if(other)target--;

    for(let i=0;i<c-target;i++){
        parent.lastChild.remove();
    }

    for(let i=++c;i<=target;i++){
        console.log(i);
        let element = document.createElement('p');
        element.innerHTML = ""+i+". <input type='text'>";
        parent.appendChild(element);
    }

    if(other){
        let element = document.createElement('p');
        element.innerHTML = "その他.<input type='number' name='other-low' class='text-words' placeholder='最低'>~<input type='number' placeholder='最高' name='other-high' class='text-words'>";
        parent.appendChild(element);
    }

    c=target;
}

document.querySelector('#other').onchange = () => {
    if(document.querySelector('#select-quantity').value == 0);
    else if(document.querySelector('#other').checked){
        document.querySelector('#question-edit').lastChild.remove();
        let element = document.createElement('p');
        element.innerHTML = "その他.<input type='number' name='other-low' class='text-words' placeholder='最低'>~<input type='number' placeholder='最高' name='other-high' class='text-words'>";
        document.querySelector('#question-edit').appendChild(element);
    }else{
        document.querySelector('#question-edit').lastChild.remove();
        let element = document.createElement('p');
        element.innerHTML = document.querySelector('#select-quantity').value+". <input type='text'>";
        document.querySelector('#question-edit').appendChild(element);
    }
}

for(const element of document.querySelectorAll('.attributes')){
    console.log('aoih')
    const parent = document.querySelector('#if-selector');
    element.onchange = () => {
        if(element.checked){
            let newIf = document.createElement('input');
            newIf.type = 'radio';
            newIf.name = 'select';
            newIf.id = element.id + "-radio";
            newIf.className = 'radio'
            parent.appendChild(newIf);
            let newLabrl = document.createElement('label');
            newLabrl.innerText = element.parentNode.lastChild.innerText;
            newLabrl.for = element.id + "-radio";
            newLabrl.id = element.id + "-radio-label"
            parent.appendChild(newLabrl);
        }else if(parent.querySelector('#'+element.id + "-radio")){
            parent.querySelector('#'+element.id + "-radio").remove();
            parent.querySelector('#'+element.id + "-radio-label").remove();
        }
    }
}

