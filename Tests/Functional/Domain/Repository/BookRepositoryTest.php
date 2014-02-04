<?php

namespace RobertLemke\Example\Bookshop\Tests\Functional\Domain\Repository;

use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

class BookRepositoryTest extends \TYPO3\Flow\Tests\FunctionalTestCase {

	static protected $testablePersistenceEnabled = TRUE;

	/**
	 * @var \RobertLemke\Example\Bookshop\Domain\Repository\BookRepository
	 */
	protected $bookRepository;

	/**
	 * @var \RobertLemke\Example\Bookshop\Tests\Functional\Fixtures\BookFixtureFactory
	 */
	protected $bookFixtureFactory;

	public function setUp() {
		parent::setUp();

		$this->bookRepository = $this->objectManager->get('RobertLemke\Example\Bookshop\Domain\Repository\BookRepository');
		$this->bookFixtureFactory = $this->objectManager->get('RobertLemke\Example\Bookshop\Tests\Functional\Fixtures\BookFixtureFactory');
	}

	/**
	 * @test
	 */
	public function findOneByIsbnFindsBookByIsbn() {
			// Set up test data
		$this->bookFixtureFactory->createValidBook(array('isbn' => '12345678'));
		$this->persistenceManager->persistAll();

			// Execute
		$book = $this->bookRepository->findOneByIsbn('12345678');

			// Assertions
		$this->assertInstanceOf('\RobertLemke\Example\Bookshop\Domain\Model\Book', $book);
		$this->assertSame('12345678', $book->getIsbn());
	}

	/**
	 * @test
	 */
	public function findOneByTitleFindsBookByTitle() {
			// Set up test data
		$this->bookFixtureFactory->createValidBook(array('title' => 'TYPO3 Neos'));
		$this->persistenceManager->persistAll();

			// Execute
		$book = $this->bookRepository->findOneByTitle('TYPO3 Neos');

			// Assertions
		$this->assertInstanceOf('\RobertLemke\Example\Bookshop\Domain\Model\Book', $book);
		$this->assertSame('TYPO3 Neos', $book->getTitle());
	}

}