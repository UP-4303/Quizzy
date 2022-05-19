var fileInput = document.querySelector("#file");

fileInput.addEventListener("change", changeFileName);

function changeFileName() {
	var fileName = 'Parcourir...';
	if (fileInput.files.length == 1) {
		fileName = fileInput.target.value.split('\\').pop();
	}
	fileInput.nextElementSibling.innerHTML = fileName;
}