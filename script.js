

var form = document.getElementById("interestform");

form.addEventListener("submit", function (e){
    e.preventDefault();
    var formData = {};
    console.log(form.elements);
        for (var i = 0; i < form.elements.length; i++) {
            var element = form.elements[i];
            if (element.name) {
                formData[element.name] = element.value;
            }
        }
    var jsonOutput = document.getElementById("jsonOutput");
    jsonOutput.textContent = JSON.stringify(formData, null, 2);
});
