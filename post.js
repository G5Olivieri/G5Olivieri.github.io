function post() {
    var data = {};

    for(var i = 0; i < form.length; i++) {
        data[form[i]['name']] = form[i]['value'];
    }
    $.ajax({
        type: 'POST',
        url: 'api1.php',
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