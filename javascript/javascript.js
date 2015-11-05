/**
 * Display the menu when called
 * @param obj the object fired
 */
function displayMenu(obj){

    var idMenu     = obj.id;
    var idSubMenu = 'sub' + idMenu;
    var subMenu   = document.getElementById(idSubMenu);
    var idSubMenuOne;
    var subMenuOne;

    if(idMenu == 'menu1')
    {
        for (var menuNumber = 2 ; menuNumber < 5 ; menuNumber++) {
            idSubMenu = 'submenu' + menuNumber ;
            subMenu = document.getElementById(idSubMenu);
            subMenu.style.display = "none";
        }
        idSubMenu = 'submenu' + 1 ;
        subMenu = document.getElementById(idSubMenu);
    }
    else
    {
        idSubMenuOne = 'submenu1';
        subMenuOne = document.getElementById(idSubMenuOne);
        subMenuOne.style.display = "none";
    }
    if(subMenu.style.display == "none"){
        subMenu.style.display = "block";
    }
    else{
        subMenu.style.display = "none";
    }

}

//Not work ! It's suppose to close category and open the another filters
function changeMenu(){

    var id          = 1 ;
    var idSubMenu = 'submenu' + id ;
    var subMenu   = document.getElementById(idSubMenu);

    subMenu.style.display = "none";

    id = 2 ;
    for (id ; id < 5 ; id++) {
        idSubMenu = 'submenu' + id ;
        subMenu = document.getElementById(idSubMenu);
        subMenu.style.display = "block";
    }

}

function getValueInSelect(id)
{
    var e = document.getElementById(id).value;
    return e.options[e.selectedIndex].text;
}

/**
 * Changes 'range' for a new price
 * @param newPriceValue the new price to display
 */
function displayPrice(newPriceValue)
{
        document.getElementById('range').innerHTML = newPriceValue;
}

