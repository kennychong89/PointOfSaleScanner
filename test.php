 <?php
 	// Initialize inventory, listings, and terminal objects.
	/*
	$product_inventory = new Inventory();

	// add products and prices here. 
	$product_inventory->add("A", 2.00, [4=>7.00]);
	$product_inventory->add("B", 12.00);
	$product_inventory->add("C", 1.25, [6=>6.00]);
	$product_inventory->add("D", 0.15);

	$product_listing = new Listing($product_inventory);
	$terminal = new terminal($product_listing);
	$count = 0;
	*/
    if (isset($_POST["data"])) {
        echo $_POST["data"];
    }
?>