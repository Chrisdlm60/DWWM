x = 12;
y = 28;

console.log(y);
console.log(x);

document.getElementById("resulty").innerHTML = y;

mytxt = "Ce n'est pas mon premier javascript";

//alert('La valeur de x est: ' + x + "\n" + 'mon texte est: '+ mytxt);

console.log(mytxt);


console.log(typeof mytxt);


function javascript()
{
    //mytxt = "Ceci est un test";
    var Result ;
    //
    
    //    
    
    if (x < 15)
    {
        Result = "texte n°1, x = " + x;
    }
    else if (x <= 20)
    {
        Result = "texte n°2, x = " +  x;
    }
    else
    {
        Result = "texte n°3, x = " + x ;
    }   
    console.log(Result);
    console.log(typeof Result);

    document.getElementById("resultx").innerHTML = x;
    
    var a, b, c, d, e, f;

    a = x + y ;
    document.getElementById("somme").innerHTML = a;
    console.log(a);

    b = x * y ;
    document.getElementById("multi").innerHTML = b;
    console.log(b);

    c = y / x;
    document.getElementById("division").innerHTML = c;
    console.log(c);

    e = x / y ;
    console.log(e);
    document.getElementById("div1").innerHTML = e;

    d = y % x ;
    document.getElementById("modulo").innerHTML = d;
    console.log(d);

    f = x % y;
    document.getElementById("modulo2").innerHTML = f;
    
    document.getElementById("Resultat").innerHTML = Result ;

    if(x <= 20)
        x += 2;
    else
        x -= 10 ;


}


