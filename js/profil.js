var fileInput = document.querySelector("#file");

fileInput.addEventListener("change", changeFileName);

function changeFileName(e) {
	var fileName = 'Parcourir...';
	if (fileInput.files.length == 1) {
		fileName = e.target.value.split('\\').pop();
	}
	fileInput.nextElementSibling.innerHTML = fileName;
}