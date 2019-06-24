<?php
/*
	представление страницы "добавить новую страну"
*/

global $regexp_config;
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/headerView.php';
?>
	<section id="addCoutry">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="sect1__h2">add coutry</h1>
				</div>
				<div class="col-12">
					<div class="form__wrap">
						<form class="form">
							<input class="form__input" id="coutry" type="text" placeholder="Coutry" minlength="1" maxlength="32" title="from 1 to 32 latin/russian letters, numbers, space, apostrophe, hyphen" pattern="<?php echo $regexp_config['regexpCountryHtml']; ?>" required></input>
							
							<input class="form__input" id="numberOfPeople" type="text" placeholder="Number of people" minlength="1" maxlength="13" title="from 1 to 13 numbers" pattern="<?php echo $regexp_config['regexpNumberOfPeopleHtml']; ?>" required></input>
							
							<button class="form__button" type="button">add coutry</button>
						</form>
					</div>
					<div class="ajax"></div>
				</div>
			</div>
		</div>
	</section>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/footerView.php';
