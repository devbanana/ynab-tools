Feature: A new user can be created

    In order to manage my budget
    As a visitor to YNAB Tools
    I want to be able to create a new account.

    Scenario: Create an account
        When I provide the following information:
        | email     | foo@example.com |
        | password | TvLm^Y5P        |
        Then an account should be created.
