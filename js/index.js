/*jshint esversion : 6 */
const Nom=
{
    0: "Tahar",
    1: "Dylan",
    2: "Abdoulaye",
    3: "Thomas B.",
    4: "Christophe",
    5: "Vincent",
    6: "Thomas C.",
    7: "Stephane",
    8: "Clement",
    9: "Sebastien",
    10: "Caroline",
    11: "Alicia",
    12: "Thomas M.",
    13: "Kevin",
    14: "Yann-Alban",
    15: "Julien",
    16: "Jeason"
};

function Random1(max)
{
    var index = getRandomInt(max);
    document.getElementById("randomNomCroissant").innerHTML = `<p>Pour les croissants:</p> ${Nom[index]}`;
}
function getRandomInt(max)
{
    return Math.floor(Math.random()* Math.floor(max));
}
function Random2(max)
{
    var index = getRandomInt(max);
    document.getElementById("randomAtelier").innerHTML = `<p>Pour l'atelier du mardi:</p> ${Nom[index]}`;
}