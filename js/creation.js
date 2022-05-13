var name_input = document.getElementById("nameinput")
var name_label = document.getElementById("nametext")
var qcm_input = document.getElementById("qcminput")
var qcm_label = document.getElementById("qcmtext")
var quizz_input = document.getElementById("quizzinput")
var quizz_label = document.getElementById("quizztext")
var buttoncontinue = document.getElementById("continue")


function displayContinue(){
	name_input.style.display = "none"
	name_label.style.display = "none"
	qcm_input.style.display = "none"
	qcm_label.style.display = "none"
	quizz_input.style.display = "none"
	quizz_label.style.display = "none"
	buttoncontinue.style.display = "none"
}

buttoncontinue.onclick = displayContinue