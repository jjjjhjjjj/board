<!doctype html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title></title>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
	</head>
	
	<body lang="en">
		
		<form id="test">
			<p>
				<label>Secret</label><br>
				<input id="secret" value="Secret Passphrase">
			</p>
			<p>
				<label>Text</label><br>
				<textarea id="text" style="width: 500px; height: 200px">This is the secret message</textarea>
			</p>

			<input type="submit" id="submit">
		</form>

		<div id="output"></div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/crypto-js.js"></script>
		<script>
			
			
			// Simple test
			var encrypted = '' + CryptoJS.AES.encrypt("Message", "Secret Passphrase");
			var decrypted = CryptoJS.AES.decrypt(encrypted, "Secret Passphrase");
			console.log(decrypted.toString(CryptoJS.enc.Utf8));
			
			
			$(function() {
				$('#test').on('submit', function() {
					var plaintext = $('#text').val();
					var secret = $('#secret').val();
					var encrypted = '' + CryptoJS.AES.encrypt(plaintext, secret);
					console.log(encrypted);
					var decrypted = CryptoJS.AES.decrypt(encrypted, secret);
					console.log(decrypted.toString(CryptoJS.enc.Utf8));
					return false;
				});
				
			});
			
		</script>
	</body>
</html>