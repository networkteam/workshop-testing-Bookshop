<?php

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode,
	Behat\MinkExtension\Context\MinkContext;
use TYPO3\Flow\Utility\Arrays;
use PHPUnit_Framework_Assert as Assert;

require_once(__DIR__ . '/../../../../../Flowpack.Behat/Tests/Behat/FlowContext.php');

/**
 * Features context
 */
class FeatureContext extends MinkContext {

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var \RobertLemke\Example\Bookshop\Tests\Functional\Fixtures\BookFixtureFactory
	 */
	protected $bookFixtureFactory;

	/**
	 * Initializes the context
	 *
	 * @param array $parameters Context parameters (configured through behat.yml)
	 */
	public function __construct(array $parameters) {
		$this->useContext('flow', new \Flowpack\Behat\Tests\Behat\FlowContext($parameters));
		$this->objectManager = $this->getSubcontext('flow')->getObjectManager();

		$this->bookFixtureFactory = $this->objectManager->get('RobertLemke\Example\Bookshop\Tests\Functional\Fixtures\BookFixtureFactory');
	}

	/**
	 * @Given /^the following books exist:$/
	 */
	public function theFollowingBooksExist(TableNode $table) {
		$rows = $table->getHash();

		foreach ($rows as $row) {
			$this->bookFixtureFactory->createValidBook($row);
		}

		$this->getSubcontext('flow')->persistAll();
	}

	/**
	 * @Then /^I should see an info message "(.*)"$/
	 */
	public function iShouldSeeAnInfoMessageAddedTypoNeosToYourShoppingBasket($message) {
		$this->assertSession()->elementTextContains('css', 'ul.unstyled li', $message);
	}

	/**
	 * @Given /^I should see one product in my basket$/
	 */
	public function iShouldSeeOneProductInMyBasket() {
		$this->assertSession()->elementTextContains('css', '.badge-success', 1);
	}

	/**
	 * @Given /^the loading indicator is gone$/
	 */
	public function theLoadingIndicatorIsGone() {
			// Wait until loader is shown
		$this->getSession()->wait(10000, "document.getElementById('spinner')");
		$this->assertSession()->elementExists('css', '#spinner');
			// Wait until loader is removed
		$this->getSession()->wait(10000, "document.getElementById('spinner') === null");
		$this->assertSession()->elementNotExists('css', '#spinner');
	}

	/**
	 * @Given /^I wait until I see a message$/
	 */
	public function iWaitUntilISeeAMessage() {
		$time = 0;
		while($time < 30) {
			$message = $this->getSession()->getPage()->find('css', 'ul.unstyled li');
			if ($message !== NULL) {
				return;
			}
			sleep(1);
			$time++;
		}
		throw new Exception('No message found after 30 seconds');
	}

}
