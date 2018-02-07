# blog
A blog+database, for the third CodeGorilla assignment. Live version: http://wijzijncodegorilla.nl/julia/blog/

# Version 1.7 (07.02.2018)

version 1.7: added a password protected section (.htaccess) for the blogger/admin, with the option to post articles, and remove comments. These functions are no longer available for regular visitors. .htpasswds file is located in the "verywellhidden" folder. Preset usernames and passwords are "blogger";"blogger" and "admin";"admin". Blogger can also choose to disable comments via the submit form [w3-006; w4-002; w4-002]

version 1.6: added commentsection, the option to delete individual comments, and multiple comments per blogpost [w3-006; w4-002; w4-002; W4-005].

version 1.5:  minor fixes, cleaned up a bit, added images and text to main page.

version 1: added the option the add categories, fixed an issue with blogpost length. 

version 0.5:

 -added text editor to submit form, and edited javascript code to work with html tags (innerhtml instead of textnode creation).

 -added sort by catagory function, cleaned up javascript and php code. Homepage shows latest 5 posts. 

 -Blog site with submit page, blogs are stored in the database, and shown on the homepage (most recent posts first).

version 0.1: base html, and css layout (please excuse the colorscheme). Including a (hidden) submit form.

# progression: 
https://trello.com/b/uJAwxdJQ/blog



### User stories:

Week 3 (version 1):

Story id | as a..| I want..| so ..
------------ | -------------| -------------| -------------
W3-001 | Blogger| post articles on my blog| I can share my ideas with others
W3-002 | Reader| To have an overview of my favorite bloggers articles, most recent posts at the top| read the most recent posts
W3-003| Blogger| Link my article to a category| Mmy readers can find easily find articles on specific topics
W3-004 | Reader| To select articles from a specific category, via a sidebar| I can easily find all articles related to a certain topic
W3-005 | Blogger| to add categories myself| I don't depend on my blogs developer as much
W3-006 | Blogger| to add multiple categories to a single article| i don't have to limit myself to a single theme or topic
W3-007 | Blogger| to be able to format the text| I can convey my messages more clearly.
W3-008 | Blogger| to add images to my articles| so I can show off my cats

Week 4 (Version 2):

Story id | as a..| I want..| so..
------------ | -------------| -------------| -------------
W4-001 | Blogger| a text-expander that automatically translates predefined abbreviations to full text| can write articles faster
W4-002 | Reader| leave anonymous comments on articles| I can voice my opinion on articles
W4-003 | Reader| To select articles from a specific category, without reloading the entire page| see W3-004
W4-004 | Blogger| to be able to remove individual comments| I can stop trolls and spam
W4-005 | Blogger| to be able to decide whether my article will have a commentsection| To prevent offensive comments on sensitive topics.

### Finished userstories

- W3-001
- W3-002
- W3-003
- W3-004
- W3-006
- W3-005
- W3-007
- W3-008


- W4-002
- W4-003
- W4-004
- W4-005

## to do:

- W4-001

- combine some of the php files
- clean up code
- css



