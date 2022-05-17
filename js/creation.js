var qform = document.getElementById("qform1")
var qwrapper = document.getElementById("qwrapper")
var quizz_input = document.getElementById("quizzinput")
var initform = document.getElementById("initform")
var qcmform = document.getElementById("qcmform")
var quizzform = document.getElementById("quizzform")
var formulaire = document.getElementById("formulaire")
var is_quizz = false

function sendForm(){
	var questions = []
	var results = {}

	if (is_quizz){
		results["jauges"] = []
		for (var i of document.getElementsByClassName("jaugelabel")){
			results["jauges"].push({"label":i.value})
		}
	}else{
		results["required_points"] = document.getElementById("minpoints").valueAsNumber
	}

	for (var q of qwrapper.childNodes){
		if (q.nodeType != 1) continue
		questions.push({"label":q.getElementsByClassName("questiontext")[0].value, "choices":[]})
		for (var c of q.getElementsByClassName("ansinput")){
			if (c.style.display != "") continue
			if (is_quizz){
				questions[questions.length-1]["choices"].push( {"label":c.getElementsByClassName("anslabel")[0].value, "jauge":c.getElementsByClassName("jauges")[0].value} )
			}else{
				questions[questions.length-1]["choices"].push( {"label":c.getElementsByClassName("anslabel")[0].value, "points":c.getElementsByClassName("points")[0].valueAsNumber} )
			}
		}
	}
	var quest = document.createElement("input")
	quest.setAttribute("type", "text")
	quest.setAttribute("value", JSON.stringify(questions))
	formulaire.appendChild(quest)
	var resp = document.createElement("input")
	resp.setAttribute("type", "text")
	resp.setAttribute("value", JSON.stringify(results))
	formulaire.appendChild(resp)
	//formulaire.submit()
}

function isquizz(){
	is_quizz = quizz_input.checked
	updateLabels()
}

initform.addEventListener("click", isquizz)

function addmore(button){
	var clone = button.parentElement.cloneNode(true)
	clone.id = ""
	button.parentElement.after(clone)
	updateLabels()
}

function remove(button){
	var div = button.parentElement
	if (qwrapper.childNodes.length > 1) div.parentElement.removeChild(div)
	updateLabels()
}

function updateLabels(){
	var nb = 1
	for (var div of qwrapper.childNodes){
		if (div.nodeType != 1) continue
		div.getElementsByClassName("ansnumber")[0].addEventListener("input", displayAnswers)
		div.getElementsByClassName("qnumber")[0].textContent = `Question ${nb}`
		for (var e of div.getElementsByClassName("jauges")){
			e.style.display = is_quizz?"":"none"
		}
		for (var e of div.getElementsByClassName("points")){
			e.style.display = is_quizz?"none":""
		}
		nb++
	}
	qcmform.style.display = is_quizz?"none":""
	quizzform.style.display = is_quizz?"":"none"
}

function displayAnswers(evt){
	var select = evt.currentTarget
	var ansinput = select.parentElement.getElementsByClassName("ansinput")
	var nb = parseInt(select.value)
	var c = 0
	for (var i of ansinput){
		i.style.display = c>=nb?"none":""
		c++
	}
}