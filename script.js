let amount=document.getElementById("amount");
let duration=document.getElementById("duration");

let payment=document.getElementById("payment");

function calculate(){

let loan=amount.value;
let months=duration.value;

let interest=0.05;

let total=loan*(1+interest);

let monthly=(total/months).toFixed(2);

payment.innerText="$"+monthly;

document.getElementById("amountValue").innerText="$"+loan;

document.getElementById("durationValue").innerText=months+" months";

}

amount.oninput=calculate;
duration.oninput=calculate;

calculate();

function nextPage(){
window.location="apply.html";
}