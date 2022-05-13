var quizz_input = document.getElementById("quizzinput")
var initform = document.getElementById("initform")
var questionform = document.getElementById("questionform")

var reptext3 = document.getElementById("reptext3")
var reptext4 = document.getElementById("reptext4")
var repinput3 = document.getElementById("repinput3")
var repinput4 = document.getElementById("repinput4")

function displayAnswers(){
	console.log("yo")
	var nb = parseInt(ansnumber.value)
	reptext3.style.display = nb>2?"":"none"
	repinput3.style.display = nb>2?"":"none"
	reptext4.style.display = nb>3?"":"none"
	repinput4.style.display = nb>3?"":"none"
}

var ansnumber = document.getElementById("ans_number")
ansnumber.addEventListener("input", displayAnswers)

function displayContinue(){
	initform.style.display = "none"
	questionform.style.display = ""
	var is_quizz = quizz_input.checked
}

buttoncontinue.onclick = displayContinue