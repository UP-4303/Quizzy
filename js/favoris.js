var icone_fav = document.getElementsByClassName("icone_fav");

icone_fav.addEventListener("click", clicfav);

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function clicfav() {
	if (icone_fav.className == "icone_fav added") {
		icone_fav.className = "icone_fav"
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_empty.png')";
		await sleep(600);
	} else {
		icone_fav.className = "icone_fav added"
		iconeMenu.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_full.png')";
		await sleep(600);
	}
}