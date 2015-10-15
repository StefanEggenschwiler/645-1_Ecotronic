/**
 * Display the menu when called
 * @param obj the object fired
 */
function displayMenu(obj){

    var idMenu     = obj.id;
    var idSubMenu = 'sub' + idMenu;
    var subMenu   = document.getElementById(idSubMenu);


    if(subMenu.style.display == "none"){
        subMenu.style.display = "block";
    }
    else{
        subMenu.style.display = "none";
    }

}

/**
 * Changes 'range' for a new price
 * @param newPriceValue the new price to display
 */
function displayPrice(newPriceValue)
{
        document.getElementById('range').innerHTML = newPriceValue;
}
