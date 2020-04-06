Feature: Score List in JSON format
  Background:
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"

  Scenario: Getting a list of scores (first page, 10 items per page)
    When I send a "GET" request to "/score/" with parameters:
      | key                    | value  |
      | page                   | 1      |
      | limit                  | 10     |
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "items" should exist
    And the JSON node "meta" should exist

  Scenario: Getting a list of scores sorted by undefined sorting logic
    When I send a "GET" request to "/score/" with parameters:
      | key                    | value  |
      | sort                   | id.asc |
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "items" should not exist
    And the JSON node "meta" should not exist

  Scenario: Getting a list of scores sorted by date.asc sorting logic
    When I send a "GET" request to "/score/" with parameters:
      | key                    | value  |
      | sort                   | date.asc |
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Getting a list of scores sorted by date.desc sorting logic
    When I send a "GET" request to "/score/" with parameters:
      | key                    | value  |
      | sort                   | date.desc |
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Getting a list of scores sorted by score.asc sorting logic
    When I send a "GET" request to "/score/" with parameters:
      | key                    | value  |
      | sort                   | score.asc |
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Getting a list of scores sorted by score.desc sorting logic
    When I send a "GET" request to "/score/" with parameters:
      | key                    | value  |
      | sort                   | score.desc |
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
