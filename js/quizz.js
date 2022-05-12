var title = document.getElementById("title")
var under_title = document.getElementById("question")
var buttons = [document.getElementById("choix_un"),document.getElementById("choix_deux"),document.getElementById("choix_trois"),document.getElementById("choix_quatre")]
var index = -1

function next_question(){
	index++
	var data = questions[index]
	title.innerHTML = data.label
	for (var i in data.choices){
		var choice = data.choices[i]
		buttons[i].innerHTML = choice.label
	}
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

for (var q of questions){
	
}