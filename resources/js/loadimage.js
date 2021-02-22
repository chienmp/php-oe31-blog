$("#file").on("keyup change", function(e) {
    document.getElementById("img").height = "200";
    document.getElementById("img").width = "200";
    var output = document.getElementById('img');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
})
