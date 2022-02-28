<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/x-icon" href="favicon.ico">

		<meta content="dekomori desu - url shortener" property="og:title" />
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
		<title>dekomori desu - url shortener</title>
	</head>
	<script type="module">
		Vue.createApp({
			data() {
				return {
					urlForm: {
						urlInput: "",
						safetyPage: false
					},
					show: false,
					urlCode: "",
					error: false,
					errorMessage: "An error occured"
				}
			},
			methods: {
				addURL(e) {
					axios.post("app/submit.php", this.urlForm)
						.then((res) => {
							console.log(res)
							if(res.data.code){
								this.urlCode = res.data.code
								this.show = true
								this.error = false
								console.log(res.data.code)
							} else if(res.data.error) {
								this.error = true
								this.show = false
								this.errorMessage = res.data.error
							} else {
								this.error = true
							}
						})
						.catch((error) => {
							this.show = false
							this.error = true
						}).finally(() => {
							this.urlForm.urlInput = ""
							this.urlForm.safetyPage = false
						})
				}
			}
		}).mount('#app')
	</script>
	<body>
		<div id="app">
			<div class="container">
				<div class="d-flex justify-content-center align-items-center vh-100">
					<div class="card text-center" style="width: 20rem;">
						<div class="card-body text-white">
							<form v-on:submit.prevent="addURL">
								<div class="mb-3">
									<label for="urlInput" class="form-label">URL</label>
									<input type="url" v-model="urlForm.urlInput" class="form-control" name="urlInput" id="urlInput" aria-describedby="urlHelp">
									<div id="urlHelp" class="form-text text-white">Enter a URL to be shortened</div>
								</div>
								<div class="mb-3 form-check">
									<input type="checkbox" v-model="urlForm.safetyPage" class="form-check-input" name="safetyPage" id="safetyPage">
									<label class="form-check-label" for="safetyPage">Enable safety page</label>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
								<br><br>
								<p v-if="show">Short url:</p><p v-if="show">https://l.deko.moe/go/{{ urlCode }}</p>
								<p v-if="error" class="text-danger">{{ errorMessage }}</p>
								<a href="https://deko.moe" class="card-link" style="text-decoration: none; color: white;">Main page</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://kit.fontawesome.com/fd1445f088.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
	<script>
		var sakura = new Sakura('body', {
			fallSpeed: 1
		});
	</script>
</html>