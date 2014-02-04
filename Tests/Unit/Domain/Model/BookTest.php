<?php

namespace RobertLemke\Example\Bookshop\Tests\Unit\Domain\Model;

use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

class BookTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function getPublisherGetsInformationFromIsbnLookupService() {
			// Set up
		$book = new Book();
		$book->setIsbn('12345678');

		$isbnLookupService = $this->getMock('RobertLemke\Example\Bookshop\Service\IsbnLookupService');

		$bookInfo = array('publisher' => 'M. Muster');
		$isbnLookupService->expects($this->once())
			->method('getBookInfo')
			->with('12345678')
			->will($this->returnValue($bookInfo));

		$this->inject($book, 'isbnLookupService', $isbnLookupService);

			// Execute
		$publisher = $book->getPublisher();

			// Assertions
		$this->assertSame('M. Muster', $publisher);
	}

}