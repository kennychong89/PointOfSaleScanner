<?php
/*
* Test Cases Here for the Oroduct class.
*/

include 'inventory.php';
include 'terminal.php';
class ListingClassTest extends PHPUnit_Framework_TestCase {
	function ProductListing() {
		$inventory = new Inventory();
		$productListing = new Listing($inventory);
		
		$inventory->add('Kappa Shave', 3.75, ['3'=>4.50,'5'=>5.50]);
		$this->assertEquals($productListing->getUnitPrice('Kappa Shave'), 3.75);
		$this->assertEquals($productListing->getUnitPrice('Keepo Shave'), null);
		
		$productListing->updateUnitPrice('Kappa Shave', 2.53);
		$this->assertEquals($productListing->getUnitPrice('Kappa Shave'), 2.53);

		$this->assertEquals($productListing->getVolumePrice('Kappa Shave', 3), 4.50);
		$this->assertEquals($productListing->getVolumePrice('Kappa Shave', 5), 5.50);

		$productListing->addVolumePrice('Kappa Shave', 6, 2.34);
		$this->assertEquals($productListing->getVolumePrice('Kappa Shave', 6), 2.34);

		$productListing->removeVolumePrice('Kappa Shave', 6);
		$this->assertEquals($productListing->getVolumePrice('Kappa Shave', 6), null);	

		$productListing->removeVolumePrice('Kappa Shave', 32);
		$this->assertEquals($productListing->getVolumePrice('Kappa Shave', 32), null);

		$productListing->addVolumePrice('Kappa Shave', 6, 2.34);
		$this->assertEquals($productListing->getVolumePrice('Kappa Shave', 6), 2.34);

		//$this->assertEquals($productListing->getVolumePrices('Kappa Shave'), [4.50, 5.50, 2.34]);
	}

	function InvoiceSystem() {
		$inventory = new Inventory();
		$inventory->add('Kappa Shave', 3.75, [2=>5.50, 5=>8.50, 6=>9.23, 10=>20.00]);
		
		$product_listing = new Listing($inventory);

		$invoice = new ProductInvoice($product_listing);
		$total_scanned = 20;

		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), 40);

		$invoice->clear();
		$this->assertEquals($invoice->getTotal(), 0);

		$total_scanned = 1;
		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), 3.75);
		$invoice->clear();

		$total_scanned = 2;
		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), 5.50);
		$invoice->clear();
		
		$total_scanned = 7;
		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), 9.23 + 3.75);
		$invoice->clear();
		
		$total_scanned = 30;
		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), 60.00);
		$invoice->clear();
		
		$total_scanned = 11;
		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), 20.00 + 3.75);
		$invoice->clear();
		
		$total_scanned = 115;
		$this->addToInvoice($invoice, 'Kappa Shave', $total_scanned);
		$this->assertEquals($invoice->getTotal(), (10 * 20.00) + (20.00+8.50));
		$invoice->clear();

		$inventory->add('Keepo Shave', 3.00);
		$total_scanned = 1;
		$this->addToInvoice($invoice, 'Keepo Shave', $total_scanned);
		$this->addToInvoice($invoice, 'Kappa Shave', 5);		
		$this->assertEquals($invoice->getTotal(), (8.50 + 3.00));
		$invoice->clear();

		$product_listing->addVolumePrice('Keepo Shave', 3, 1.25);
		$product_listing->addVolumePrice('Keepo Shave', 5, 5.00);
		$this->addToInvoice($invoice, 'Keepo Shave', 18);
		$this->addToInvoice($invoice, 'Kappa Shave', 5);		
		$this->assertEquals($invoice->getTotal(), (8.50 + 15.00 + 1.25));
		$invoice->clear();
	}

	function addToInvoice($invoice, $item, $total_scanned) {
		for ($i = 0; $i < $total_scanned; $i++) {
			$invoice->add($item);
		}
	}

	function testTTerminalAPI() {
		$inventory = new Inventory();
		$inventory->add("A", 2.00, [4=>7.00]);
		$inventory->add("B", 12.00);
		$inventory->add("C", 1.25, [6=>6.00]);
		$inventory->add("D", 0.15);

		$product_listing = new Listing($inventory);

		$terminal = new Terminal($product_listing);

		// test1
		for ($i = 0; $i < 10; $i++) {
			$terminal->scan('A');
		}
		$terminal->scan('B');

		$this->assertEquals($terminal->getTotalPrice(), 7.00 + 7.00 + 2.00 + 2.00 + 12.00);

		$terminal->reset();

		//$this->assertEquals($terminal->getTotalPrice(), (40.00+25.00+10.00+(4*2.50)+4.25));
	}	
}
?>