var iconeMenu = document.querySelector(".iconeMenu");
var menu_col = document.querySelector("#menu_pannel");
var menu = "close";

iconeMenu.addEventListener("click", clicMenu);

// met fonction en pause pour que l'animation puisse se faire
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// gère l'affichage ou non du menu latérale
async function clicMenu() {
	if (menu == "close") {
		menu_col.className = "no_margin menu_open";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.gif')";
		await sleep(600);
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.jpg')";
		menu = "open";
	} else {
		menu_col.className = "no_margin menu_close";
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu_reverse.gif')";
		await sleep(600);
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/menu.jpg')";
		menu = "close";
	}
}

