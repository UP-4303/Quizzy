console.log("Hello world")
var next = document.getElementById("continue")
var qform = document.getElementById("qform1")
var qwrapper = document.getElementById("qwrapper")
var nb = 1

function addmore(luu){
	console.log(luu)
	var clone = qform.cloneNode(true)
	nb++
	clone.id = "qform" + nb
	qwrapper.appendChild(clone)
	var tmp = document.getElementById("qform"+nb)
	var label = tmp.getElementsByClassName("qnumber")[0]
	label.textContent = `Question ${nb}`
}

/*var quizz_input = document.getElementById("quizzinput")
var qnumberhtml = document.getElementById("question_number")
var initform = document.getElementById("initform")
var questionform = document.getElementById("questionform")
var buttoncontinue = document.getElementById("continue")
var reptext3 = document.getElementById("reptext3")
var reptext4 = document.getElementById("reptext4")
var repinput3 = document.getElementById("repinput3")
var repinput4 = document.getElementById("repinput4")

var q = []
var results = {}
var q_number = 1

function displayAnswers(){
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
	qnumberhtml.innerHTML = `Question ${q_number}`
	var is_quizz = quizz_input.checked
}

buttoncontinue.onclick = displayContinue*/