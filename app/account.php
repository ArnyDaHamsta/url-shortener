<?php
	session_start();
	require("locale.php");
	$app = new urlShortener();
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
					apiKey: ''
				}
			},
			mounted() {
				axios.post("app/getUserAccount.php")
					.then((res) => {
						console.log(res)
						if(res.data){
							this.apiKey = res.data
						}
					})
					.catch((error) => {
					}).finally(() => {})
			},
			methods: {
				updateAPIKey() {
					axios.post("app/updateAPIKey.php")
						.then((res) => {
							console.log(res)
							if(res.data){
								this.apiKey = res.data
							}
						})
						.catch((error) => {
						}).finally(() => {})
				}
			}
		}).mount('#app')
	</script>
	<body>
		<div id="app">
			<div class="container">
				<div class="d-flex justify-content-center align-items-center vh-100">
					<div class="row">
						<div class="card text-center" style="width: 40rem;">
							<div class="card-body text-white">
								<h5 class="card-title" class="form-label">Account details for <?php echo $_SESSION["username"]; ?></h5><br>
								<div class="form-group row">
									<div class="col-sm-12">
										<div class="input-group">
											<input type="text" id="token" class="form-control privacy-blur" v-model="apiKey" readonly>
											<div class="input-group-append">
												<button class="btn btn-success btn-clipboard" type="button" data-clipboard-target="#token"><i class="fas fa-fw fa-copy"></i> Copy</button>
												<button class="btn btn-primary refresh-token" data-id="1" type="button" @click="updateAPIKey()"><i class="fas fa-fw fa-sync"></i> Update</button>
											</div>
										</div>
										<label class="form-check-label" for="token">API Token</label><br>
										<br><a href="https://l.deko.moe/logout" class="card-link" style="text-decoration: none; color: white;"><?php echo $translator->translate('logout') ?></a><br>
										<br><a href="https://l.deko.moe/" class="card-link" style="text-decoration: none; color: white;">Go back</a><br>
									</div>
								</div>
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