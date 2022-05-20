//Gestion des quizz

//Note : quizz_data et can_like sont chargés dans la page quizz.php

//Récupération des éléments html
var quizz_name = document.getElementById("quizz_name")
var quizz_question_number = document.getElementById("quizz_question_number")
var quizz_question = document.getElementById("quizz_question")
var buttons = [document.getElementById("choix_un"),document.getElementById("choix_deux"),document.getElementById("choix_trois"),document.getElementById("choix_quatre")]
var questions = JSON.parse(quizz_data.questions)
var results = JSON.parse(quizz_data.results)
//Set les variables
var is_quizz = quizz_data.is_quizz=="1"?true:false //false => qcm / true => jauges
var index = -1 //Correspond à l'index de la question

if (is_quizz){
	var jauges = [0,0,0,0]
}else{
	var points = 0
}

function buttonClicked(evt){
	if (is_quizz){
		jauges[evt.currentTarget.value]++
	}else{
		points = points + parseInt(evt.currentTarget.value)
	}
	next_question()
}


function next_question(){
	//Appelé au début et à chaque changement de question
	index++
	for (var button of buttons){ //Réinitialisation des boutons
		button.style.display = "none"
		button.onclick = null
	}
	if (index == questions.length){ // Questions finies ?
		end_quizz()
	}else{
		//Affichage prochaine question
		var data = questions[index] //Sous forme {"label":string, choices:[{"label":string, "points":int OU "jauge":int}, ...]}
		quizz_question.innerHTML = data.label
		quizz_question_number.innerHTML = `Question ${index+1}/${questions.length}`
		for (var i in data.choices){
			var choice = data.choices[i]
			buttons[i].innerHTML = "<div class=\"answer_name\">" + choice.label + "</div>"
			//Redéfini les boutons
			if (is_quizz){
				buttons[i].value = choice.jauge
			}else{
				buttons[i].value = choice.points
			}
			buttons[i].style.display = "" //affiche le bouton (donc uniquement ceux dont on a besoin.)
			buttons[i].addEventListener("click", buttonClicked)
		}
	}
}

function find_answer(jauges){
	//Fonction sortant la jauge maximale des 4 jauges.
	var maxi = jauges[0]
	var index = 0
	for (var i in jauges){
		if (jauges[i] > maxi){
			maxi = jauges[i]
			index = i
		}
	}
	return results.jauges[index]
}

function find_qcm_answer(points){
	//Fonction sortant un tableau avec le nb de points, sur combien au maximum et si oui ou non on a réussi le test
	var maxi = 0
	for (var q of questions){
		var p = 0
		for (var c of q.choices){
			if (parseInt(c.points) > p){
				p=parseInt(c.points)
			}
		}
		maxi=maxi+p
	}
	return [points, maxi, results.required_points<=points]
}

function end_quizz(){
	//Fonction appelé à la fin du quizz
	//Récupération des résultats et affichage
	if (is_quizz){
		var res = find_answer(jauges)
		quizz_question_number.innerHTML = res.label
		quizz_question.style.display = "none"
	}else{
		var res = find_qcm_answer(points)
		quizz_question_number.innerHTML = `${res[2]?"Test passé !":"Test raté !"} ${res[0]}/${res[1]}`
		quizz_question.innerHTML = `Note minimale requise : ${results.required_points}/${res[1]}`
	}
	//Gestion du bouton de like
	//can_like prend 3 valeurs : 0 => non connecté, 1 => connecté et liké, 2 => connecté et pas liké
	var like = document.getElementById("like")
	var icone_fav = document.querySelector(".icone_fav");
	if(can_like == 0) {
		like.style.display = "none"
	}else if (can_like == 1){
		icone_fav.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_full.png')";
		like.style.display = ""
	} else {
		icone_fav.style.backgroundImage = "url('/l1_info_4/Quizzy/images/fav_empty.png')";
		like.style.display = ""
	}
}


//Premier appel permettant d'afficher la question 1
next_question()