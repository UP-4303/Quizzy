var iconeMenu = document.querySelector(".iconeMenu");
var menu_col = document.querySelector(".menu");
var menu = "close";

iconeMenu.addEventListener("click", clicMenu);
	
function clicMenu() {
	if (menu == "close") {
		iconeMenu.className = "iconeMenu afficheMenu";
		menu_col.className = "menu menu_oui";
		menu = "open";
	} else {
		iconeMenu.className = "iconeMenu";
		menu_col.className = "menu menu_non";
		menu = "close";
	}
}
