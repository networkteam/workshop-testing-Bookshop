<?php

namespace RobertLemke\Example\Bookshop\Tests\Unit\Domain\Model;

use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

class BasketTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function getTotalWithEmptyBooksReturnsZero() {
			// Set up
		$basket = new Basket();

			// Execute
		$total = $basket->getTotal();

			// Assertions
			// Equals -> ==
			// Same -> ===
		$this->assertSame(0, $total);
	}

	/**
	 * @test
	 */
	public function getTotalWithMultipleBooksReturnsSumOfBookPrices() {
			// Set up
		$basket = new Basket();

		$book1 = new Book();
		$book1->setPrice(1200);
		$basket->addBook($book1);

		$book2 = new Book();
		$book2->setPrice(1400);
		$basket->addBook($book2);

			// Execute
		$total = $basket->getTotal();

			// Assertions
		$this->assertSame(2600, $total);
	}

}