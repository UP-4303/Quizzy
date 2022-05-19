var qwrapper = document.getElementById("qwrapper")
var quizz_input = document.getElementById("quizzinput")
var initform = document.getElementById("initform")
var qcmform = document.getElementById("qcmform")
var quizzform = document.getElementById("quizzform")
var formulaire = document.getElementById("formulaire")
var is_quizz = false
var quizzname = document.getElementById("quizzname")
var errorbalise = document.getElementById("error")

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
	var j = ["A", "B", "C", "D"]
	for (var q of qwrapper.getElementsByClassName("qform")){
		questions.push({"label":q.getElementsByClassName("questiontext")[0].value, "choices":[]})
		for (var c of q.getElementsByClassName("ansinput")){
			if (c.style.display != "") continue
			if (is_quizz){
				questions[questions.length-1]["choices"].push( {"label":c.getElementsByClassName("anslabel")[0].value, "jauge":j.indexOf(c.getElementsByClassName("jauges")[0].value)} )
			}else{
				questions[questions.length-1]["choices"].push( {"label":c.getElementsByClassName("anslabel")[0].value, "points":c.getElementsByClassName("points")[0].valueAsNumber} )
			}
		}
	}
	if (questions.length < 5){
		errorbalise.innerHTML = "Vous devez mettre au moins 5 questions."
		return
	}

	var quest = document.createElement("input")
	quest.setAttribute("type", "text")
	quest.setAttribute("name", "questions")
	quest.setAttribute("value", makeSafer(JSON.stringify(questions)))
	formulaire.appendChild(quest)
	var res = document.createElement("input")
	res.setAttribute("type", "text")
	res.setAttribute("name", "results")
	res.setAttribute("value", makeSafer(JSON.stringify(results)))
	quizzname.value = makeSafer(quizzname.value)
	formulaire.appendChild(res)
	formulaire.submit()
}

function makeSafer(text){
	//On met des antislash devant les caractères bizarres
	return text.replace(/'/g, "\\'").replace(/`/g, "\\`").replace(/</g, "&lt;")
}

function isquizz(){
	is_quizz = quizz_input.checked
	updateLabels()
}

initform.addEventListener("click", isquizz)

function addmore(button){
	if (qwrapper.getElementsByClassName("qform").length >= 20){
		errorbalise.innerHTML = "Quizz limité à 20 questions."
	}else{
		var clone = button.parentElement.cloneNode(true)
		clone.id = ""
		button.parentElement.after(clone)
		updateLabels()
	}
	
}

function remove(button){
	var div = button.parentElement
	if (qwrapper.getElementsByClassName("qform").length > 1){
		div.parentElement.removeChild(div)
		updateLabels()
	}else{
		errorbalise.innerHTML = "Vous ne pouvez pas avoir un quizz sans question. . _." //c'est un smiley, pas du morse
	}
	
}

function updateLabels(){
	var nb = 1
	for (var div of qwrapper.getElementsByClassName("qform")){
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