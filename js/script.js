var iconeMenu = document.querySelector(".iconeMenu");
var menu_col = document.querySelector(".menu");
var menu = "close";

iconeMenu.addEventListener("click", clicMenu);

function clicMenu() {
	if (menu == "close") {
		iconeMenu.style.backgroundImage = "";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.gif')";

		menu_col.className = "menu menu_oui";
		menu = "open";
	} else {
		iconeMenu.style.backgroundImage = "";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.gif')";

		menu_col.className = "menu menu_non";
		menu = "close";
	}
}