

var form = document.getElementById("interestform");

form.addEventListener("submit", function (e){
    e.preventDefault();
    var formData = {};
    var ensembles = [];
        for (var i = 0; i < form.elements.length; i++) {
            console.log(form.elements[i]);
            var element = form.elements[i];
            if (element.name && element.name != "ensemble") {
                formData[element.name] = element.value;
            }
        }
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].checked) {
            ensembles.push(checkboxes[i].value);
          }
        }
        formData["ensembles"] = ensembles;
    var jsonOutput = document.getElementById("jsonOutput");
    jsonOutput.textContent = JSON.stringify(formData, null, 2);
});
