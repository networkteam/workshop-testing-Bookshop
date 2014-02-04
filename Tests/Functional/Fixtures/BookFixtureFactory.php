<?php
namespace RobertLemke\Example\Bookshop\Tests\Functional\Fixtures;

class BookFixtureFactory extends \Flowpack\Behat\Tests\Functional\Fixture\FixtureFactory {

	protected $baseType = 'RobertLemke\Example\Bookshop\Domain\Model\Book';

	protected $fixtureDefinitions = array(
		'validBook' => array(
			'isbn' => '12345678',
			'title' => 'TYPO3 Neos',
			'description' => '...',
			'price' => 49
		)
	);

}