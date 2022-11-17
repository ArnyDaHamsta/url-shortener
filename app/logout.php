<?php
	session_start();
	require("locale.php");
?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/x-icon" href="favicon.ico">

		<meta content="Deko - URL Shortener" property="og:title" />
		<meta content="https://deko.moe" property="og:url" />
		<meta content="very cool and good site" property="og:description" />
		<meta content="https://deko.moe/images/icon.png" property="og:image" />
		<meta content="#fd79a8" data-react-helmet="true" name="theme-color" />

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/sakura.css"/>
		<script src="https://unpkg.com/vue@3"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<script src="../js/sakura.js"></script>
		<title>Deko - URL Shortener</title>
	</head>
	<script type="module">
		Vue.createApp({
			data() {
				return {

				}
			},
			methods: {

			}
		}).mount('#app')
	</script>
	<body>
		<div id="app">
			<div class="container">
				<div class="d-flex justify-content-center align-items-center vh-100">
					<div class="row">
						<div class="card text-center" style="width: 20rem;">
							<div class="card-body text-white">
								<?php
									echo $translator->translate('loggedout');
                                    header("Refresh: 2; URL=https://l.deko.moe");
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://kit.fontawesome.com/fd1445f088.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
	<script src="../js/background.js"></script>
</html>