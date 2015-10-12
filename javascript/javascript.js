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

//when a page is loaded by clicking on a tab,
// it will look at the name of the page and change de class to the tab to be "active"

//$(function () {
//    var namePage = location.pathname.split('/').slice(-1)[0];
//
//    if(namePage == "addNewDevice.php"){
//
//        $("a").removeClass("active");
//        $("#nav").addClass("active");
//
//    }
//
//
//})





function displayPrice(newPriceValue)
{
        document.getElementById('range').innerHTML = newPriceValue;
}