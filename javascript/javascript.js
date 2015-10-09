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

$(function () {
        $("a").removeClass('active');

        var $parent = $(this);
        if (!$parent.hasClass('active')) {
            $parent.addClass('active');
        }
        e.preventDefault();
});


function displayPrice(newPriceValue)
{
        document.getElementById('range').innerHTML = newPriceValue;
}