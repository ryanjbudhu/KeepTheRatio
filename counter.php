<!DOCTYPE html>
<html>

  <head>
    
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">

    <title>Keep The Ratio</title>

    <link href="style/style.css" rel="stylesheet" type="text/css">

  </head>

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<?PHP
		$con = mysqli_connect("sql.njit.edu", USERNAME, PASSWORD);
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));	
		}
		mysqli_select_db($con,"rjb57");
		$sql = "SELECT * FROM rjb57.count";
		$dbCount = mysqli_query($con,$sql);
		$countList = mysqli_fetch_array($dbCount);
		$guys = $countList['guys'];
		$girls = $countList['girls'];
		mysqli_close($con);
	?>
	
	<body>
	
		 <div class="container">
				<div class="grid">
					 <p class="title">GUYS:</p>
					 <p class="digit" id="guys"><?PHP echo $guys; ?></p>
				</div>
					
				<div class="button">
					<button id="guysMinus" class="btn_minus" onclick="minus('guys')">&ndash;</button>
					<button class="btn_plus" onclick="plus('guys')">+</button>
				</div>
			</div>

			<div class="container">
				<div class="grid">   
					 <p class="title">GIRLS:</p>
					 <p class="digit" id="girls"><?PHP echo $girls; ?></p>
				</div>

				<div class="button">
					<button id="girlsMinus" class="btn_minus" onclick="minus('girls')">&ndash;</button>
					<button class="btn_plus" onclick="plus('girls')">+</button>
				</div>
			</div>

			<div class="container">
				<div class="grid">   
					 <p class="title">TOTAL:</p>
					 <p class="digit" id="total"><?PHP echo $guys+$girls; ?></p>
				</div>

				<div class="button">
					<button class="btn_reset" onclick="confirmReset()">RESET</button>
				</div>
			</div>
		
	</body>
	
	<script>			
	
    document.getElementById("guysMinus").setAttributeNode(document.createAttribute("disabled"));
    document.getElementById("girlsMinus").setAttributeNode(document.createAttribute("disabled"));

		function plus(id) {
     if (parseInt(document.getElementById(id).innerHTML,10)>-1){
				document.getElementById(id+"Minus").removeAttribute("disabled");
			}

			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","setup/editCount.php?q="+id+"&action=%2B",true);
			xmlhttp.send();
			
			/*document.getElementById("total").innerHTML = parseInt(document.getElementById("guys").innerHTML,10) + parseInt(document.getElementById("girls").innerHTML,10);*/

			var curr = document.getElementById(id).innerHTML;
			//document.getElementById(id).innerHTML = parseInt(curr,10) + 1;


		}
		function minus(id) {
				if (parseInt(document.getElementById(id).innerHTML,10)<1){
					document.getElementById(id+"Minus").setAttributeNode(document.createAttribute("disabled"));
          return;
				}
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET","setup/editCount.php?q="+id+"&action=-",true);
				xmlhttp.send();
				
				/*document.getElementById("total").innerHTML = parseInt(document.getElementById("guys").innerHTML,10) + parseInt(document.getElementById("girls").innerHTML,10);*/

				var curr = document.getElementById(id).innerHTML;
				//document.getElementById(id).innerHTML = parseInt(curr,10) - 1;			
		}
		function confirmReset() {
			if (confirm("Are you sure you want to reset?")){
				reset();
			}
		}
		function reset() {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","setup/editCount.php?r=reset",true);
			xmlhttp.send();
			
			/*document.getElementById("guys").innerHTML = 0;
			document.getElementById("girls").innerHTML = 0;*/
      location.reload();
		}
		
		function liveUpdate(col) {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(document.getElementById(col).innerHTML != this.responseText){
						document.getElementById(col).innerHTML = this.responseText;
					}
				}
			};
			xmlhttp.open("GET","setup/liveUpdate.php?q="+col,true);
			xmlhttp.send();
			
      // updateTotal() {
			document.getElementById("total").innerHTML = parseInt(document.getElementById("guys").innerHTML,10) + parseInt(document.getElementById("girls").innerHTML,10);
      // }
		}
		window.setInterval(function () {
			liveUpdate("guys")}, 250);
		window.setInterval(function () {
			liveUpdate("girls")}, 250);
	</script>
</html>
