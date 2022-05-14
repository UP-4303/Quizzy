var iconeMenu = document.querySelector(".iconeMenu");
var menu_col = document.querySelector(".menu");
var menu = "close";

iconeMenu.addEventListener("click", clicMenu);

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function clicMenu() {
	if (menu == "close") {
		menu_col.className = "menu menu_oui";
		menu = "open";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.gif')";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.jpg')";
		await sleep(630);

	} else {
		menu_col.className = "menu menu_non";
		menu = "close";

		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.gif')";
		await sleep(630);
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.jpg')";
	}
}