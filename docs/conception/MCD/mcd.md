REGISTER : register_identifier, mail, password
have, 11 USERS, 01 REGISTER
ROLES : role_identifier, label
connect, 0N LANGUAGES, 0N ORGANIZATIONS 
ORGANIZATIONS : organization_identifier, title, description, picture
belong, 11 PROJECTS, 0N ORGANIZATIONS

:
USERS: user_identifier, lastname, firstname
be, 11 ROLES, 01 USERS
LANGUAGES : language_identifier, label, picture
make, 0N LANGUAGES, 1N PROJECTS
PROJECTS : project_identifier, title, picture, url,