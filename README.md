## Wordpress Developer Challenge
# TASK
- Create a plugin that allows the admin to search an api and return results in a table displayed in the WP Admin Plugin page
    - API Endpoint: http://jservice.io/api/clues  (  clues.json )
- Each result should have a save button that creates a post with the following data saved:
    - Post Title = item.question
    - Post Content = item.answer
    - Post Type = jeopardy