var iconeMenu = document.querySelector("iconeMenu");
var menu = "close";

iconeMenu.addEventListener("click", clicMenu);
	
function clicMenu() {
	if (menu == "close") {
		iconeMenu.className = "iconeMenu afficheMenu";
		menu = "open";
	} else {
		iconeMenu.className = "iconeMenu";
		menu = "close";
	}
}
