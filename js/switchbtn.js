let colordetail = "#DFB216";
let colorwhite = "#F8F8F8";
let colorblack = "#10141b";

document.querySelector('#btn-topscore').addEventListener("click", topscoreFunc);
document.querySelector('#btn-yourscore').addEventListener("click", yourscoreFunc);

function topscoreFunc(){
    let topscore = document.querySelector('#btn-topscore');
    let yourscore = document.querySelector('#btn-yourscore');

    topscore.style.backgroundColor = colordetail;
    topscore.style.color = colorwhite;
    yourscore.style.backgroundColor = colorwhite;
    yourscore.style.color = colorblack;

    document.querySelector('#topscore').style.display = "block";
    document.querySelector('#yourscore').style.display = "none";
};

function yourscoreFunc(){
    let topscore = document.querySelector('#btn-topscore');
    let yourscore = document.querySelector('#btn-yourscore');

    topscore.style.backgroundColor = colorwhite;
    topscore.style.color = colorblack;
    yourscore.style.backgroundColor = colordetail;
    yourscore.style.color = colorwhite;

    document.querySelector('#topscore').style.display = "none";
    document.querySelector('#yourscore').style.display = "block";
};