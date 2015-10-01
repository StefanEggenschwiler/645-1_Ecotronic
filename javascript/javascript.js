/**
 * Created by Jerem on 01.10.2015.
 */

function displayMenu(obj){

    var idMenu     = obj.id;
    var idSousMenu = 'sous' + idMenu;
    var sousMenu   = document.getElementById(idSousMenu);


    if(sousMenu.style.display == "none"){
        sousMenu.style.display = "block";
    }
    else{
        sousMenu.style.display = "none";
    }

}