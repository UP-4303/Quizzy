var iconeMenu = document.querySelector(".iconeMenu");
var menu = "close";

iconeMenu.addEventListener("click", clicMenu);
	
function clicMenu() {
	if (menu == "close") {
		vitrine.className = "vitrine afficheMenu";
		iconeMenu.className = "iconeMenu afficheMenu";
		menu = "open";
	} else {
		vitrine.className = "vitrine";
		iconeMenu.className = "iconeMenu";
		menu = "close";
	}
}
