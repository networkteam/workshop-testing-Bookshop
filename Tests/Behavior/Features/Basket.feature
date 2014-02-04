Feature: Add book to shopping basket
  In order to add books for a checkout process
  As a customer
  I need a add to shopping cart button for books

  Background:
    Given the following books exist:
      | title      |
      | TYPO3 Neos |

  @fixtures @javascript
  Scenario: Add book to empty basket
    Given I am on "/books"
    When I press "Add to Basket"
    And I wait until I see a message
    Then I should see an info message "Added "TYPO3 Neos" to your shopping basket."
    And I should see one product in my basket
