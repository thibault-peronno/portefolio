REGISTER : (register_identifier, mail, password, #user_identifier)
ROLES : (role_identifier, label)
USERS: (user_identifier, lastname, firstname, #role_identifier)
ORGANIZATIONS : organization_identifier, title, description, picture
LANGUAGES : language_identifier, label, picture
PROJECTS : (project_identifier, title, picture, url, #organization_identifier)
PROJECTS_LANGUAGES : (project_language_identifier, #project_identifier, #language_identifier)
ORGANIZATIONS_LANGUAGES : (organization_language_identifier, #organization_identifier, #language_identifier)