<?php
	require dirname(__DIR__, 1) . "/vendor/autoload.php";
	$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
	$dotenv->load();
	use Laminas\I18n\Translator\Translator;

	$translator = new Translator();
	$translator->addTranslationFile("phpArray", $_ENV["APP_ROOT"] . "/app/lang/en_GB.php", "default", "en_GB");
	$translator->addTranslationFile("phpArray", $_ENV["APP_ROOT"] . "/app/lang/nb_NO.php", "default", "nb_NO");
	if (isset($_SESSION["loggedin"])) {
		$language = $_SESSION["language"];
		Locale::setDefault($language);
	} else {
		Locale::setDefault("en_GB");
	}
?>