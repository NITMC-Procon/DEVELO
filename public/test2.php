

<p id="text">nothing</p>
<form id="forms">
    <input type="file" name="file" id="file" enctype="multipart/form-data">
    <input type="file" name="s" id="s">
    <input type="button" value="決定" id="sub" onclick="alerter();">
    <script>
        const form = document.getElementById("forms");
        var formdata = new FormData(form);
        var c = 1;

        alerter = function()
        {
            var file = document.getElementById('file').files[0];

            document.getElementById('s').files[0] = file;

            console.log(document.getElementById('s').files[0]);

            formdata.append('files',file);
            for(let value of formdata.entries()){
                console.log(c,value);
            }
            c++;
        }

        
        form.addEventListener("submit",function(e){

            e.preventDefault();
            new FormData(form);
        })

        form.addEventListener('formdata',(e) => {
            console.log('bibibi!');
            var text = document.getElementById("text");


            formdata.delete('file')
            for(let value of formdata.entries()){
                console.log("fin",value);
            }

            let request = new XMLHttpRequest();
            request.open("POST","/test2.php");
            request.responseType = "blob"
            request.onload = () =>{
                text.innerHTML = request.response;
                console.log(request.response);
            }
            request.send(formdata);

        })

    </script>
    <input type="submit">
</form>