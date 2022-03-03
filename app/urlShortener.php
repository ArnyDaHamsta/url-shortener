<?php
	require dirname(__DIR__, 1) . '/vendor/autoload.php';
	require("locale.php");
	$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
	$dotenv->load();

	$conn = new mysqli($_ENV["MYSQL_HOST"], $_ENV["MYSQL_USERNAME"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DB"]);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	class urlShortener
	{
		public function getUrl($code) {
			global $conn;

			$sql = "SELECT url, short, safe FROM url WHERE short = '" . $conn->real_escape_string($code) . "'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$url = $row["url"];
					$safety = $row["safe"];
					return [$url, $safety];
				}
			} else {
				return false;
			}
		}

		protected function generateShort($length = 8) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		protected function getUserIP() {
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}

		public function generateResponse($responseType, $message) {
			$codeArray = array($responseType => $message);
			$payload = json_encode($codeArray);
			return $payload;
		}

		public function getCurrentURL() {
			if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
				$url = "https://";
			} else {
				$url = "http://";
			}
			$url .= $_SERVER['HTTP_HOST'];
			$url .= $_SERVER['REQUEST_URI'];
			return $url;
		}

		protected function checkCooldown($ip) {
			global $conn;

			$sql = "SELECT id, ip, date FROM url WHERE ip = '" . $conn->real_escape_string($ip) . "' ORDER BY id DESC LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$time = strtotime($row["date"]);
					if(time() - $time <= 5){
						return true;
					}
				}
			} else {
				return false;
			}
		}

		public function addUrl($url, $safe) {
			global $conn;
			global $translator;

			$randomString = $this->generateShort();
			$ip = $this->getUserIP();

			if($safe == "on") {
				$safe = 1;
			} else {
				$safe = 0;
			}

			if(!filter_var($url, FILTER_VALIDATE_URL)){
				return ["error", $translator->translate('invalidURL')];
			}

			if($this->checkCooldown($ip)){
				return ["error", $translator->translate('pleaseWait')];
			}

			$stmt = $conn->prepare("INSERT INTO url (url, short, safe, ip) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssis", $conn->real_escape_string($url), $randomString, $safe, $ip);
			$stmt->execute();
			$stmt->close();
			$conn->close();
			return $randomString;
		}
	}
?>