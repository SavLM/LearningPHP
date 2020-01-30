<!DOCTYPE html> 
<head> 
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type = "text/javascript"> 
$(document).ready(function() { 


	$(document).on('click', '#save', function() {
		$("tr").each (function(i, obj) { 
			var arr = new Array();
			$(this).find("td").each (function(i, obj) {
				//alert($(this).find("input").val()); 
				arr.push($(this).find("input").val());
			});
			var index = arr[0];
			var model = arr[1];
			var transmission = arr[2];
			var color = arr[3]; 
			$.post("update.php", {"model" : model, "transmission" : transmission, "color" : color, "index" : index}, function(data) { });
			$.post("tabulate.php", function(data) { 
			var stuff = JSON.parse(data);
			//alert(stuff);
			var oldTable = document.getElementById("theTable");
			var newTable = "<table id='theTable' border='1' style='border-collapse:collapse'>";
			newTable += "<tr><th>ID</th><th>Type</th><th>Transmission</th><th>Color</th></tr>"
			for (var i = 0; i < stuff.length; i++) { 
				newTable += "<tr>";
				for (var j = 0; j < 4; j++) { 
					newTable += ("<td><input type=text value=" +  stuff[i][j] + "></td>");
				}
				newTable += "</tr>";
			}
			newTable += "</table>";
			$("#theTable").replaceWith(newTable);
		});

		});
	});

	$(document).on('click', '#load', function() {
		$.post("tabulate.php", function(data) { 
			var stuff = JSON.parse(data);
			//alert(stuff);
			var oldTable = document.getElementById("theTable");
			var newTable = "<table id='theTable' border='1' style='border-collapse:collapse'>";
			newTable += "<tr><th>ID</th><th>Type</th><th>Transmission</th><th>Color</th></tr>"
			for (var i = 0; i < stuff.length; i++) { 
				newTable += "<tr>";
				for (var j = 0; j < 4; j++) { 
					newTable += ("<td><input type=text value=" +  stuff[i][j] + "></td>");
				}
				newTable += "</tr>";
			}
			newTable += "</table>";
			$("#theTable").replaceWith(newTable);
		});
	});
});

function getdata() { 
}
</script>
</head>
<body> 
<div id="page" align="center">
	<button id='load'>Show Cars</button>
	<br/>
	<table id = "theTable"> </table>
	<br/>
	<button id='save'>Save</button>
</div>
</body>
