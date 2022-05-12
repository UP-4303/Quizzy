var quizz_name = document.getElementById("quizz_name")
var quizz_question_number = document.getElementById("quizz_question_number")
var quizz_question = document.getElementById("quizz_question")
var buttons = [document.getElementById("choix_un"),document.getElementById("choix_deux"),document.getElementById("choix_trois"),document.getElementById("choix_quatre")]
var index = -1
var is_quizz = true
if (is_quizz){
	var jauges = [0,0,0,0]
}else{
	var points = 0
}


function buttonClicked(evt){
	if (is_quizz){
		jauges[evt.currentTarget.value]++
	}else{
		points = points + evt.currentTarget.value
	}
	next_question()
}

for (var button of buttons){
	button.addEventListener("click", buttonClicked)
}


function next_question(){
	index++
	if (index == questions.length) return end_quizz()
	var data = questions[index]
	quizz_question.innerHTML = data.label
	quizz_question_number.innerHTML = `Question ${index+1}/${questions.length}`
	for (var i in data.choices){
		var choice = data.choices[i]
		buttons[i].innerHTML = "<div class=\"answer_name\">" + choice.label + "</div>"
		buttons[i].value = choice.jauge
	}
}

function find_answer(jauges){
	var maxi = jauges[0]
	var index = 0
	for (var i in jauges){
		if (jauges[i] > maxi){
			maxi = jauges[i]
			index = i
		}
	}
	return results.jauges[i]
}

function end_quizz(){
	for (var button of buttons){
		button.style.visibility = "hidden"
		button.onclick = null
	}
	var res = find_answer(jauges)
	quizz_question_number.innerHTML = res.label
	quizz_question.style.visibility = "hidden"
}


var questions = [
  {
		"label": "Vous voyez un noir, que faites vous?",
		"choices": [
			{
				"label": "Rien, c'est une personne normale",
				"jauge": 0
			},
			{
				"label": "Je lui propose amicalement de rentrer dans son pays pour cultiver du coton",
				"jauge": 1
			},
			{
				"label": "Je mitraille cette hérésie",
				"jauge": 2
			},
			{
				"label": "Un noir? Il n'y a que des hommes verts dans mon entourage !",
				"jauge": 3
			}
		]
	},
	{
		"label": "Vous vous réveillez un matin et vous êtes devenu noir, que faites vous ?",
		"choices": [
			{
				"label": "Je ressemble enfin à un humain ! Parfait, je vais pouvoir infiltrer leur société",
				"jauge": 3
			},
			{
				"label": "Horrifié, j'attrape le premier objet coupant dans mon champs de vision et je me suicide sur la place publique",
				"jauge": 2
			},
			{
				"label": "Ce n'est pas normal de changer de couleur pendant son sommeil, mais ce n'est pas grave. J'espère seulement ne pas croiser mon oncle raciste",
				"jauge": 0
			},
			{
				"label": "Quelle infamie, un noir ! Ah mince, c'est le miroir...",
				"jauge": 1
			}
		]
	},
	{
		"label": "Votre femme devient noire, que faites vous ?",
		"choices": [
			{
				"label": "Je demande immédiatement le divorce",
				"jauge": 1
			},
			{
				"label": "Un espion a infiltré notre société extraterrestre, sonnez l'alarme !",
				"jauge": 3
			},
			{
				"label": "Je brûle la maison pendant qu'elle est à l'intérieur",
				"jauge": 2
			},
			{
				"label": "Ce n'est définitivement pas normal de changer de couleur, mais ce n'est pas grave",
				"jauge": 0
			}
		]
	}
]

var results = {
  "jauges":[
    {"label":"Vous êtes une personne normale aussi, bien joué à vous !", "image":"smile.jpg"},
    {"label":"Je suis au regret de vous annoncer que vous êtes raciste.", "color":"#000000"},
    {"label":"Vous êtes fiché S et devez vous rendre immédiatemment dans le commissariat le plus proche afin que les officiers puissent procéder à votre interpelation."},
    {"label":"Vous êtes un alien, veuillez contacter un scientifique pour lui faire part de vos connaissances et que vous puissiez faire avancer la science (dissection compris) !"}
  ]
}

next_question()