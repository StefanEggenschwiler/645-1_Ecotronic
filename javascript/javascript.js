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

//when the page is loaded

$(function () {

    var namePage = location.pathname.split('/').slice(-1)[0];

    if(namePage == "addNewDevice_page.php" || ""){

        $("a").removeClass("active");
        $("#addNewDevicePage").addClass("active");

    }

})