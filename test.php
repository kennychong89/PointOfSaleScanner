<?php
	include 'terminal.php';
	include 'inventory.php';

 	// Initialize inventory, listings, and terminal objects.
	$product_inventory = new Inventory();

	// add products and prices here. 
	$product_inventory->add("A", 2.00, [4=>7.00]);
	$product_inventory->add("B", 12.00);
	$product_inventory->add("C", 1.25, [6=>6.00]);
	$product_inventory->add("D", 0.15);

	$product_listing = new Listing($product_inventory);
	$terminal = new Terminal($product_listing);
	
	// scan products
    if (isset($_POST["data"])) {
    	$result = $terminal->scan($_POST["data"]);
    	
    	if ($result)
    			echo "Product " . $_POST["data"] . " is scanned";
    	else
    			echo "Product " . $_POST["data"] . " cannot be scanned";
    }

    if (isset($_GET["type"])) {
    	if ($_GET["type"] == "totalprice") {
    		echo $terminal->getTotalPrice();
    	}		
    }
?>