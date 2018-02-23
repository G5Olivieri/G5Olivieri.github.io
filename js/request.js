function get() {
    $.ajax({
        url: "php/Request/get.php",
        responseType: 'json'
    })
        .done(function(data) {
            var temp = [];
            document.querySelector("div").setAttribute("class", "container-fluid mt-4");
            document.getElementById('response').innerHTML = ""
            for(var k in data) {
                var row = document.createElement('tr');
                var id = document.createElement('td');
                var name = document.createElement('td');
                id.innerHTML = data[k]['id'];
                name.innerHTML = data[k]['fname'];
                row.appendChild(id);
                row.appendChild(name);
                document.getElementById('response').appendChild(row);
            }
        });
}

function post() {
    var data = {};
    var formArr = $("#myForm").serializeArray();

    if(!validar()) {
        alert('Preencha todos os campos')
        return;
    }

    for(var i = 0; i < formArr.length; i++) {
        data[formArr[i]['name']] = formArr[i]['value'];
    }
    $.ajax({
        type: 'POST',
        url: 'php/Request/post.php',
        responseType: 'json',
        dataType: 'json',
        data: JSON.stringify(data),
    })
        .done(function(data){
            if(document.getElementById('resp').children) {
                document.getElementById('resp').innerHTML = " ";
            }
            var temp = [];
            for(var k in data){
                var cre = document.createElement('p');
                cre.innerHTML = k + ": " + data[k];
                document.getElementById('resp').appendChild(cre);
            }
        });
}

function validar() {
    var teste = true;
    var input = $("#myForm").children();
    for(var i = 0; i < input.length; i++){
        if(input[i].value == "" || input[i].value == null) {
            teste  = false;
        }
        input[i].value = "";
    }
    return teste;
}