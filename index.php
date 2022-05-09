<?php
include("lib/head.php");

print_r($_SESSION);
unset($_SESSION);
?>

<a href="user_signup.php">connexion</a>

<ul id="list_quizz">
	<li class="quizz">abc</li>
	<li class="quizz">def</li>
	<li class="quizz">ghi</li>
	<li class="quizz">jkl</li>
	<li class="quizz">mno</li>
	<li class="quizz">pqr</li>
	<li class="quizz">stu</li>
	<li class="quizz">vwx</li>
	<li class="quizz">yz </li>
</ul>

<?php
include("lib/foot.php");
?>