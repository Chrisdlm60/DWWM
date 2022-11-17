/*jshint esversion: 6 */
/////////////////Exercice sur le BOM et DOM//////////////////
console.log("Exercice javascript");
Fruit = ["Orange","Litchi","Pomme","Cerise","Datte","Tomate","Poire"];

Legume = ["Poireau","Navet","Aubergine","Carotte","Tomate"];

const contain = Legume.concat(Fruit);

var c = 3;
var d = 15;

// while (i <= length.Fruit)
// {
//     console.log(Fruit[i]);
//     console.log("ok");
//     i++;
// }
Fruit.forEach(element => console.log(element));

// for (var i = 0;i <= length.Fruit;i++)
// {
//     console.log(Fruit[i]);
//     console.log("ok");
//     document.getElementById("Fruit").innerHTML = Fruit[i];
// }
console.log(Fruit);
console.log(Legume);
console.log("Fruits triés :"+Fruit.sort());
console.log(Legume.concat(Fruit));

Fruit.forEach(element => document.getElementById("Fruit").innerHTML += "<br>" + element);

function Trier()
{
    Fruit.sort();
    console.log(Fruit);
    Fruit.forEach(element => document.getElementById("Fruittrier").innerHTML += " " + element);
}
function Fusion()
{
    console.log(contain);
    contain.forEach(element => document.getElementById("FruitetLegume").innerHTML += "<br>" + element);
}
function somme(a,b)
{
    var x = a + b;
    console.log(x);
    document.getElementById("BOMDOM").innerHTML = x;
    //return x;
}
function Renverse ()
{
    Fruit.reverse();
    Fruit.forEach(element => document.getElementById("reverse").innerHTML += "<br>" + element);
}
function Pop()
{
    Fruit.pop();
    console.log("Tomate supprimé");
    Fruit.forEach(element => document.getElementById("pop").innerHTML += " " + element);
}
function Split()
{
    var tab = 'Nous sommes le Mardi 6 Octobre 2020.';
    var mot = tab.split(' ');
    console.log(mot[3]);
    //expected 'Mardi'

    var caract = tab.split('');
    console.log(caract[1]);
    //expected 's'
}
function Join()
{
    var tabjoin = Fruit.join();
    document.getElementById("join").innerHTML = tabjoin;
}

///////// Passage de la chaîne de caractère en majuscule///////
var minuscule = "developpeur web et web mobile";
console.log(minuscule);
var Majuscule = minuscule.toUpperCase();
console.log(Majuscule);