Feature: Log in to YNAB Tools
  In order to manage my account
  As a user
  I want to be able to log in.

  Scenario:
    Given I am a registered user with the email "foo@example.com" and the password "bar"
    And I go to "/login"
    When I fill in "Email" with "foo@example.com"
    And I fill in "Password" with "bar"
    And I press "Sign in"
    Then I should be on the homepage
