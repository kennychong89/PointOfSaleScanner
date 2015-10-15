<?php 
	include 'terminal.php'; 
	include 'inventory.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>php demo</title>
  <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
</head>
<body>
  <h1>Question</h1>
  <pre>Consider a store where items have prices per unit but also volume
prices. For example, apples may be $1.00 each or 4 for $3.00.

Implement a point-of-sale scanning API that accepts an arbitrary
ordering of products (similar to what would happen at a checkout line)
and then returns the correct total price for an entire shopping cart
based on the per unit prices or the volume prices as applicable.

Here are the products listed by code and the prices to use (there is
no sales tax):
Product Code | Price
--------------------
A            | $2.00 each or 4 for $7.00
B            | $12.00
C            | $1.25 or $6 for a six pack
D            | $0.15

There should be a top level point of sale terminal service object that
looks something like the pseudo-code below. You are free to design and
implement the rest of the code however you wish, including how you
specify the prices in the system:

terminal->setPricing(...)
terminal->scan("A")
terminal->scan("C")
... etc.
result = terminal->total

Here are the minimal inputs you should use for your test cases. These
test cases must be shown to work in your program:

Scan these items in this order: ABCDABAA; Verify the total price is $32.40.
Scan these items in this order: CCCCCCC; Verify the total price is $7.25.
Scan these items in this order: ABCD; Verify the total price is $15.40.

</pre>

<h1>Your answer can use the form below</h1>
<form method="post" action="" id="target">
  <input type="text" name="product_txt" />
  <button type="submit" name="submit" id="process">Submit</button>
</form>

<div class="result">

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#target").submit(function(event) {
			$.ajax({
				type: "POST",
				url: "test.php",
				data : ({data:"test"}),
				success: function(data) {
					alert(data);
				}
			});

			event.preventDefault();
		});
	});
	
		/*var button = document.getElementById("process");

		button.addEventListener("click", function(event) {
			event.preventDefault();
			var input = document.getElementsByName("product_txt")[0];
			processInput(input.value);
		});

		function processInput(input) {
			for (var i = 0; i < input.length; i++) {
				var item = input.charAt(i);

				// no spaces
				if (item != ' ') {		
					sendInput(item);
				}	
			}
		}

		function sendInput(item) {
			var hp = new XMLHttpRequest();
			var url = "index.php";
			var params = "data=" + item;

			hp.open("POST", url, true);
			hp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hp.onreadystatechange = function() {
				if (hp.readyState == 4 && hp.status == 200) {
					alert(hp.responseText);
				}
			}
			hp.send(params);

			return false;
		}

		function createParagraphNode(text) {
			var node = document.createElement("p");
			var textNode = document.createTextNode(text);
			node.appendChild(textNode);

			return node;
		}
		*/
</script>

</body>
</html>