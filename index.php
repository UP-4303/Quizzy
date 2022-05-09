<?php
include("lib/head.php");

print_r($_SESSION);
unset($_SESSION);
?>

<a href="user_signup.php">connexion</a>

<ul id="list_quizz">
	<li id="test" class="quizz"><div class="nomQuizz">AAAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabc</div></li>
	<li class="quizz"><div class="nomQuizz">def</div></li>
	<li class="quizz"><div class="nomQuizz">ghi</div></li>
	<li class="quizz"><div class="nomQuizz">jkl</div></li>
	<li class="quizz"><div class="nomQuizz">mno</div></li>
	<li class="quizz"><div class="nomQuizz">pqr</div></li>
	<li class="quizz"><div class="nomQuizz">stu</div></li>
	<li class="quizz"><div class="nomQuizz">vwx</div></li>
	<li class="quizz"><div class="nomQuizz">yz </div></li>
</ul>

<?php
include("lib/foot.php");
?>