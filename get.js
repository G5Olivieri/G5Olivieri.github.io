function get() {
    $.ajax({
        url: "api.php",
        responseType: 'json'
    })
    .done(function(data) {
        var temp = [];
        document.getElementById('resp').innerHTML = ""
        console.log(data);
        for(var k in data) {
            for(var i in data[k]){
                console.log(i + ": " + data[k][i]);
                var cre = document.createElement('p');
                cre.innerHTML = i + ": " + data[k][i];
                document.getElementById('resp').appendChild(cre);
            }
        }
    })
}