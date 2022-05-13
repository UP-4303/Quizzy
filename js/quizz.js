var quizz_name = document.getElementById("quizz_name")
var quizz_question_number = document.getElementById("quizz_question_number")
var quizz_question = document.getElementById("quizz_question")
var buttons = [document.getElementById("choix_un"),document.getElementById("choix_deux"),document.getElementById("choix_trois"),document.getElementById("choix_quatre")]
var index = -1

quizz_name.innerHTML = quizz_data.name
var is_quizz = quizz_data.is_quizz
var questions = JSON.parse(quizz_data.questions)
var results = JSON.parse(quizz_data.results)

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
	return results.jauges[index]
}

function end_quizz(){
	for (var button of buttons){
		button.style.display = "none"
		button.onclick = null
	}
	var res = find_answer(jauges)
	quizz_question_number.innerHTML = res.label
	quizz_question.style.display = "none"
}

next_question()