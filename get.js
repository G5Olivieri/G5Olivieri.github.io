function get() {
    $.ajax({
        url: "api.php",
        responseType: 'json'
    })
    .done(function(data) {
        var temp = [];
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