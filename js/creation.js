//Gestion du formulaire de création

//Récupération des éléments HTML
var qwrapper = document.getElementById("qwrapper")
var quizz_input = document.getElementById("quizzinput")
var initform = document.getElementById("initform")
var qcmform = document.getElementById("qcmform")
var quizzform = document.getElementById("quizzform")
var formulaire = document.getElementById("formulaire")
var quizzname = document.getElementById("quizzname")
var errorbalise = document.getElementById("error")

//Par défaut c'est un qcm
var is_quizz = false

function sendForm(){
	//Appel lorsqu'on appuie sur le bouton pour envoyer le formulaire / créer le quizz
	var questions = []
	var results = {}
	//Création de l'objet results
	if (is_quizz){
		//Format : {"jauges":[{"label":string, ...}]}
		results["jauges"] = []
		for (var i of document.getElementsByClassName("jaugelabel")){
			results["jauges"].push({"label":i.value})
		}
	}else{
		//Format : {"required_points":int}
		results["required_points"] = document.getElementById("minpoints").valueAsNumber
	}

	if (is_quizz){
		var j = ["A", "B", "C", "D"]
	}

	//Création de l'objet questions
	//Format : [{"label":string, choices:[{"label":string, "jauge":int OU "points":int}]}]
	for (var q of qwrapper.getElementsByClassName("qform")){
		questions.push({"label":q.getElementsByClassName("questiontext")[0].value, "choices":[]})
		for (var c of q.getElementsByClassName("ansinput")){
			if (c.style.display != "") continue //Ignorer les choix cachées
			var choix_label = c.getElementsByClassName("anslabel")[0].value
			if (is_quizz){
				var string_jauge = c.getElementsByClassName("jauges")[0].value
				questions[questions.length-1]["choices"].push( {"label":choix_label, "jauge":j.indexOf(string_jauge)} )
			}else{
				var c_points = c.getElementsByClassName("points")[0].valueAsNumber
				questions[questions.length-1]["choices"].push( {"label":choix_label, "points":c_points} )
			}
		}
	}
	if (questions.length < 3){
		errorbalise.innerHTML = "Vous devez mettre au moins 3 questions."
	}else{
		if (formulaire.checkValidity()){
			//Formulaire valide
			//(Si vous avez une meilleure méthode je veux bien)
			//On crée deux nouveaux input ayant comme valeur le JSON afin de les avoir déjà fait dans l'envoi du formulaire
			var quest = document.createElement("input")
			quest.setAttribute("type", "text")
			quest.setAttribute("name", "questions")
			quest.setAttribute("value", makeSafer(JSON.stringify(questions)))
			quest.style.display = "none"
			formulaire.appendChild(quest)

			var res = document.createElement("input")
			res.setAttribute("type", "text")
			res.setAttribute("name", "results")
			res.setAttribute("value", makeSafer(JSON.stringify(results)))
			res.style.display = "none"
			quizzname.value = makeSafer(quizzname.value)
			formulaire.appendChild(res)
			//Envoi du formulaire complet
			formulaire.submit()
		}else{
			//On montre où est l'erreur du formulaire à l'utilisateur.
			formulaire.reportValidity()
		}
	}
}

function makeSafer(text){
	//On met des antislash devant les caractères bizarres et on empêche bêtement la balise html de fonctionner si il y en a.

	//Obsolète depuis qu'on utilise des patterns pour les inputs.
	return text.replace(/'/g, "\\'").replace(/`/g, "\\`").replace(/</g, "&lt;")
}

function isquizz(){
	//update la variable is_quizz selon l'input type radio
	is_quizz = quizz_input.checked
	updateLabels()
}
initform.addEventListener("click", isquizz)

function addmore(button){
	//Crée un nouveau champ de question
	if (qwrapper.getElementsByClassName("qform").length >= 20){ //Limitation à 20
		errorbalise.innerHTML = "Quizz limité à 20 questions."
	}else{
		//On clone l'élément HTML
		var clone = button.parentElement.cloneNode(true)
		clone.id = ""
		//Et on l'insère après l'élément cliqué
		button.parentElement.after(clone)
		updateLabels()
	}
	
}

function remove(button){
	var div = button.parentElement
	if (qwrapper.getElementsByClassName("qform").length > 1){ //On fait attention à ce qu'il n'en reste pas qu'un
		//On retire le champ de question cliqué
		div.parentElement.removeChild(div)
		updateLabels()
	}else{
		errorbalise.innerHTML = "Vous ne pouvez pas avoir un quizz sans question. . _." //c'est un smiley, pas du morse
	}
}

function updateLabels(){
	//Met à jour les labels, évènements et style

	var nb = 1
	for (var div of qwrapper.getElementsByClassName("qform")){ //Parcourir tout les champs de questions
		//ansnumber = le input select 'X réponses possibles'
		div.getElementsByClassName("ansnumber")[0].addEventListener("input", displayAnswers)
		//Update le titre
		div.getElementsByClassName("qnumber")[0].textContent = `Question ${nb}`
		//Affiche ou non les champs de jauges ou de points de la question selon is_quizz
		for (var e of div.getElementsByClassName("jauges")){
			e.style.display = is_quizz?"":"none"
		}
		for (var e of div.getElementsByClassName("points")){
			e.style.display = is_quizz?"none":""
		}
		nb++
	}
	//affiche la configuration des jauges ou la configuration du nombre de points minimum (pour le qcm)
	qcmform.style.display = is_quizz?"none":""
	quizzform.style.display = is_quizz?"":"none"
}

function displayAnswers(evt){
	//Appelé lors du changement d'un select pour afficher le bon nombre de champs de réponses.
	var select = evt.currentTarget
	var ansinput = select.parentElement.getElementsByClassName("ansinput")
	var nb = parseInt(select.value)
	var c = 0
	for (var i of ansinput){
		i.style.display = c>=nb?"none":""
		c++
	}
}

