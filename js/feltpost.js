//Title til post og kommentar
let title = document.querySelector('#title');
let titleoutput = document.querySelector('#titleoutput');
titleoutput.innerHTML = title.value.length+"/40";

title.addEventListener("keydown", function(){
    titleoutput.innerHTML = title.value.length+"/40";
});

//shorttext til post
let shorttext = document.querySelector('#shorttext');
let shorttextoutput = document.querySelector('#shorttextoutput');
shorttextoutput.innerHTML = shorttext.value.length+"/200";

shorttext.addEventListener("keydown", function(){
    shorttextoutput.innerHTML = shorttext.value.length+"/200";
});

//text til post
let text = document.querySelector('#text');
let textoutput = document.querySelector('#textoutput');
textoutput.innerHTML = text.value.length+"/2000";

text.addEventListener("keydown", function(){
    textoutput.innerHTML = text.value.length+"/2000";
});