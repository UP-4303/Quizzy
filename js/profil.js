var fileInput = document.querySelector("#file");

fileInput.addEventListener("change", changeFileName);

// affiche le nom de l'image dans le boutton à la place de 'Parcourir...'
function changeFileName(e) {
	var fileName = 'Parcourir...';
	if (fileInput.files.length == 1) {
		fileName = e.target.value.split('\\').pop();
	}
	fileInput.nextElementSibling.innerHTML = fileName;
}