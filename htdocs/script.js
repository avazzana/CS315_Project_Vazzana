

var form = document.getElementById("interestform");

form.addEventListener("submit", function (e){
    e.preventDefault();
    var formData = {};
    var ensembles = [];
        for (var i = 0; i < form.elements.length; i++) {
            console.log(form.elements[i]); //this is just for debugging
            var element = form.elements[i];
            if (element.name && element.name != "ensemble") {
                formData[element.name] = element.value;
                //puts the first several questions answers into a JSON object
            }
        }
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].checked) {
            ensembles.push(checkboxes[i].value);
            //handling the checkbox question was a bit trickier. Basically what I have it do is loop through the list of all checkboxes.
            //if the box is checked, the value gets added to the list
          }
        }
        formData["ensembles"] = ensembles;
    var jsonOutput = document.getElementById("jsonOutput");
    jsonOutput.textContent = JSON.stringify(formData, null, 2);
    //displays the JSON object at the top of the screen
});
