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
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.gif')";
		await sleep(600);
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.jpg')";
		menu = "open";
	} else {
		menu_col.className = "menu menu_non";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.gif')";
		await sleep(600);
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.jpg')";
		menu = "close";
	}
}