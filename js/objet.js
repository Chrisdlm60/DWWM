var personne = 
{
    nom:"DURAND",
    prenom:"Robert",
    direBonjour : function(){console.log('Bonjour');}
};
personne.direBonjour();
console.log('Monsieur '+personne.nom);
console.log(personne.prenom);

var personne2 = {};
personne2.nom = "Monsieur";
personne2.prenom = "Silence";
personne2.direBonjour = function(){console.log('Bonjour '+personne2.nom);};

personne2.direBonjour();

var Bueno = 
{
    ingredient1: "Chocolat",
    ingredient2: "Gaufrette",
    ingredient3: "Beurre de cacahuéte"
};
console.log("Les ingrédient d'un kinder bueno sont : "+Bueno.ingredient1+", "+Bueno.ingredient2+" et "+Bueno.ingredient3);