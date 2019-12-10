//Title til post og kommentar
let title = document.querySelector('#title');
let titleoutput = document.querySelector('#titleoutput');
titleoutput.innerHTML = title.value.length+"/40";

title.addEventListener("keydown", function(){
    titleoutput.innerHTML = title.value.length+"/40";
});

//text til commentar
let textcomment = document.querySelector('#textcomment');
let textoutputcomment = document.querySelector('#textoutputcomment');
textoutputcomment.innerHTML = textcomment.value.length+"/250";

textcomment.addEventListener("keydown", function(){
    textoutputcomment.innerHTML = textcomment.value.length+"/250";
});



