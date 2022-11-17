function afficherErreur (errorMsg, urlScript, lineNumber, colonne, errorObj)
{
    console.log('Message: ' + errorMsg + ' Script: ' + urlScript + ' Ligne: ' + lineNumber + ' colonne: ' + colonne + 'StackTrace: ' + errorObj);
}
window.onerror = afficherErreur;

try
{
    console.log(d);
}
catch(error)
{
    console.log("Une exception a été attrapée");
    console.log("Nom de l'exception :"+ error.name);
    console.log("Message de l'exception :"+ error.message);
}
finally{
    console.log("S'affichera avec ou sans exception");
}

console.log("     ");

try
{
    throw new Error("test");
}
catch(error)
{
    console.log("Une exception a été attrapée");
    console.log("Nom de l'exception :"+ error.name);
    console.log("Message de l'exception :"+ error.message);
}
finally{
    console.log("S'affichera avec ou sans exception");
}