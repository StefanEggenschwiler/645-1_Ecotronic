/**
 * Created by Jerem on 01.10.2015.
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


function selectedCategory(){

    var selectedCategory = null;
    var categories = document.getElementsByName("cat")

    for(var i = 0; i < categories.length; i++) {
        if(categories[i].checked == true) {
            selectedCategory = categories[i].value;
        }
    }



}