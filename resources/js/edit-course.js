let c = 0;
let result_sequence = {};
if(document.getElementById('date').value === ""){
    document.getElementById('date').value = Date.now();
}

window.onbeforeunload = () => {
    return "保存されていません"
}
//選択回答 選択肢の数およびその他の採択内容の実行
document.querySelector('#select-quantity').onchange = () => {
    let target = document.querySelector('#select-quantity').value;
    const other = document.querySelector('#other').checked;
    let parent = document.querySelector('#question-edit')

    if(other)target--;

    for(let i=0;i<c-target;i++){
        parent.lastChild.remove();
    }

    for(let i=++c;i<=target;i++){
        let element = document.createElement('p');
        element.innerHTML = ""+i+". <input type='text' name='select-text"+i+"' class='fill'>";
        parent.appendChild(element);
    }

    if(other){
        let element = document.createElement('p');
        element.innerHTML = "その他.<input type='number' name='other-low' class='text-words fill' placeholder='最低' >~<input type='number' placeholder='最高' name='other-high' class='text-words fill'>";
        parent.appendChild(element);
    }

    c=target;
}
//選択回答 数の選択後、その他の設定を変更したとき
document.querySelector('#other').onchange = () => {
    applyOther();
}

//条件分岐 取得するプロフィールの変更時に条件分岐の選択肢作成/削除
for(const element of document.querySelectorAll('.attributes')){
    const parent = document.querySelector('#if-selector');
    element.onchange = () => {
        if(element.checked){
            let newIf = document.createElement('input');
            newIf.type = 'radio';
            newIf.name = 'select';
            newIf.id = element.id + "-radio";
            newIf.value = element.id;
            newIf.className = 'radio fill'
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

for(const element of document.querySelectorAll('.type-selector')){
    element.onclick = () => {
        if(document.querySelector('#question-count').innerText){
            for(const editor of document.querySelectorAll('.editor')){
                editor.style.display = 'none';
            }
            document.querySelector("."+element.id).style.display = 'flex';
            if(document.querySelector("#" + document.querySelector('#question-count').innerText).querySelector('img').dataset.value == 'add'){
                const nextNumber = Number(document.querySelector('#main-viewer').lastElementChild.querySelector('p').innerText.split('Q')[1])+1;
                let newDiv = document.createElement('div');
                newDiv.className = 'question-pointer';
                newDiv.id = "Q"+nextNumber;
                
                let newP = document.createElement('p');
                newP.innerText = "Q"+nextNumber;
                newDiv.appendChild(newP);
                let newImg = document.createElement('img');
                newImg.setAttribute('src',document.querySelector('#url-add').dataset.url);
                newImg.dataset.value = 'add';
                newImg.className = 'viewer-icon';
                newDiv.appendChild(newImg);
                newDiv.onclick = () => {
                    document.querySelector('#question-count').innerText =  newP.innerText;
                    for(const editor of document.querySelectorAll('.editor')){
                        editor.style.display = 'none';
                    }
                    for(const indi of document.querySelectorAll('.question-pointer')){
                        indi.style.backgroundColor = "rgb(206, 241, 253)";
                    }newDiv.style.backgroundColor = 'rgb(109, 211, 246)';
                    document.forms.reset();
                    filling();
                    if(result_sequence[newP.innerText]){
                        console.log(document.querySelector('#question-count').innerText,result_sequence[document.querySelector('#question-count').innerText]);

                        let filler = document.querySelector('#'+result_sequence[newP.innerText]['type']+'-editor');
                        filler.style.display ='flex';
                        for(const name in result_sequence[newP.innerText]['content']){
                            let subject = filler.querySelector('[name='+name+']');
                            const fillValue = result_sequence[newP.innerText]['content'][name];
                            if(subject.tagName == 'INPUT'){
                                if(subject.type == 'checkbox' ){
                                    subject.checked = fillValue;
                                    subject.onchange();
                                };
                                if((subject.type == 'text' || subject.type == 'number'))subject.value = fillValue;
                                if(subject.type == 'radio')subject.value = fillValue;
                            }
                            if(subject.tagName == 'TEXTAREA')subject.value = fillValue;
                            if(subject.tagName == 'SELECT'){
                                subject.options[fillValue].selected = true;
                                filling()
                            }
                        }
                    }else{
                        document.querySelector('#add-editor').style.display = 'flex';
                    }
                }
                document.querySelector('#main-viewer').appendChild(newDiv);
            }
            const target = document.querySelector("#" + document.querySelector('#question-count').textContent).querySelector('img');
            target.dataset.value = element.id.split('-')[1];
            target.setAttribute('src',document.querySelector('#url-'+target.dataset.value).dataset.url);

            result_sequence[document.querySelector('#question-count').innerText] = {"type" : target.dataset.value ,'content' :{}};
        }
    }
}

for(const element of document.querySelectorAll('.question-pointer')){
    element.onclick = () => {
        document.querySelector('#question-count').innerText =  element.querySelector('p').innerText;
        for(const editor of document.querySelectorAll('.editor')){
            editor.style.display = 'none';
        }
        for(const indi of document.querySelectorAll('.question-pointer')){
            indi.style.backgroundColor = "rgb(206, 241, 253)";
        }element.style.backgroundColor = 'rgb(109, 211, 246)';
        document.forms.reset();
        filling();
        if(result_sequence[element.querySelector('p').innerText]){
            console.log(document.querySelector('#question-count').innerText,result_sequence[document.querySelector('#question-count').innerText]);

            let filler = document.querySelector('#'+result_sequence[element.querySelector('p').innerText]['type']+'-editor');
            filler.style.display ='flex';
            for(const name in result_sequence[document.querySelector('#question-count').innerText]['content']){
                console.log(name)
                let subject = filler.querySelector('[name='+name+']');
                if(!subject)continue;
                const fillValue = result_sequence[document.querySelector('#question-count').innerText]['content'][name];
                if(subject.tagName == 'INPUT'){
                    if(subject.type == 'checkbox' ){
                        subject.checked = fillValue;
                        subject.onchange();
                    };
                    if((subject.type == 'text' || subject.type == 'number'))subject.value = fillValue;
                    if(subject.type == 'radio' && subject.value == fillValue)subject.checked = true;
                }
                if(subject.tagName == 'TEXTAREA')subject.value = fillValue;
                if(subject.tagName == 'SELECT'){
                    subject.options[fillValue].selected = true;
                    filling()
                }
            }
        }else{
            document.querySelector('#add-editor').style.display = 'flex';
        }
    }
}

for(const element of document.querySelectorAll('.confirm')){
    element.onclick = () => {
        for(const target of document.querySelectorAll('#'+result_sequence[document.querySelector('#question-count').innerText]['type']+"-editor")){
            for(const subject of target.querySelectorAll('.fill')){
                if(subject.tagName == 'INPUT'){
                    if(subject.type == 'checkbox')result_sequence[document.querySelector('#question-count').innerText]['content'][subject.name] = subject.checked;
                    if(subject.type == 'text' || subject.type == 'number')result_sequence[document.querySelector('#question-count').innerText]['content'][subject.name] = subject.value;
                    if(subject.type == 'radio' && subject.checked)result_sequence[document.querySelector('#question-count').innerText]['content'][subject.name] = subject.value;
                }
                if(subject.tagName == 'TEXTAREA' ||subject.tagName == 'SELECT')result_sequence[document.querySelector('#question-count').innerText]['content'][subject.name] = subject.value;
            }
        }
        console.log(result_sequence);
    }
}
for(const target of document.querySelectorAll('.next')){
    target.onclick = e => {
        for(const target of document.querySelectorAll('.main-setting')){
            target.style.display = 'none';
        }
        document.querySelector('.'+e.target.dataset.n).style.display = 'contents';
        console.log(e.target.dataset.n)
    }
}

document.querySelector('#return-file').onchange = () => {
    let files =  document.querySelector('#return-file');
    let n = 0;
    for(const fileText of document.querySelectorAll('.file-texts')){
        fileText.remove();
    }
    for(const file of files.files){
        let newP = document.createElement('p');
        newP.innerText = file.name;
        newP.className = 'file-texts';
        let newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.id = 'file-text'+n;
        newP.appendChild(newInput);
        document.querySelector('#file_intro').appendChild(newP);
        n++;
    }
}

document.querySelector('#submit').onclick = () => {
    console.log(result_sequence)
    if(Object.keys(result_sequence).length){
        let send_json = {};
        send_json['content'] = result_sequence;
        send_json['title'] = document.querySelector('#course-title').value;
        send_json['profile'] = [];
        for(const attri of document.querySelectorAll('.attributes')){
            if(attri.checked){
                send_json['profile'].push(attri.value);
            }
        }
        send_json['date'] = document.getElementById('date').value;
        send_json['file'] = [];
        let files = new FormData();
        files.append('date',send_json['date'])
        let n = 0;
        for(const file of document.querySelector('#return-file').files){
            files.append(n,file)
            n++;
        }
        const json = JSON.stringify(send_json);
        const url = document.querySelector('#url-post').dataset.url;
        const urls = document.querySelector('#url-save-return').dataset.url;

        
        
        fetch(url,{
            method:'POST',
            headers:{'X-CSRF-Token':document.getElementsByName('csrf-token').item(0).content},
            body:json
        }).then(response => {
            if(response.ok){
                return response.json();
            }
        }).then(response => {
            if(response['stored']){
                fetch(urls,{
                    method:'POST',
                    headers:{'X-CSRF-Token':document.getElementsByName('csrf-token').item(0).content},
                    body:files
                }).then(res => {
                    if(res.ok){
                        return res.json();
                    }
                }).then(res=>{
                    if(res['completed']){
                        window.onbeforeunload = null;
                        window.location.href = '/admin/course/manage/'+response['id'];
                    }
                    else{
                        window.alert(res['error']);
                    }
                })
            }else{
                window.alert(response['error']);
            }
        })
    }
    
}

function filling(){

    let tar = document.querySelector('#select-quantity').value;
    const other = document.querySelector('#other').checked;
    let parent = document.querySelector('#question-edit')

    if(other)tar--;

    for(let i=0;i<c-tar;i++){
        parent.lastChild.remove();
    }

    for(let i=++c;i<=tar;i++){
        let element = document.createElement('p');
        element.innerHTML = ""+i+". <input type='text' name='select-text"+i+"' class='fill'>";
        parent.appendChild(element);
    }

    if(other){
        let element = document.createElement('p');
        element.innerHTML = "その他.<input type='number' name='other-low' class='text-words fill' placeholder='最低' >~<input type='number' placeholder='最高' name='other-high' class='text-words fill'>";
        parent.appendChild(element);
    }

    c=tar;
}

function applyOther(){
    if(document.querySelector('#select-quantity').value == 0);
    else if(document.querySelector('#other').checked){
        document.querySelector('#question-edit').lastChild.remove();
        let element = document.createElement('p');
        element.innerHTML = "その他.<input type='number' name='other-low' class='text-words fill' placeholder='最低'>~<input type='number' placeholder='最高' name='other-high' class='text-words fill'>";
        document.querySelector('#question-edit').appendChild(element);
    }else{
        document.querySelector('#question-edit').lastChild.remove();
        let element = document.createElement('p');
        element.innerHTML = document.querySelector('#select-quantity').value+". <input type='text' class='fill' name='select-text"+document.querySelector('#select-quantity').value+"'>";
        document.querySelector('#question-edit').appendChild(element);
    }
}
