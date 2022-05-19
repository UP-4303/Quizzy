var icone_fav = document.querySelector(".icone_fav");

icone_fav.addEventListener("click", clicfav);

if (icone_fav.className == "icone_fav added") {
	icone_fav.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_full.png')";
} else {
	icone_fav.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_empty.png')";
}

function clicfav() {
	if (icone_fav.className == "icone_fav added") {
		icone_fav.className = "icone_fav"
		icone_fav.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_empty.png')";
	} else {
		icone_fav.className = "icone_fav added"
		icone_fav.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_full.png')";
	}
}