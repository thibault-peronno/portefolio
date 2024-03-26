If you're working with PHP in a vanilla environment without using a framework, organizing your project with an MVC (Model-View-Controller) architecture can still be achieved effectively. Here are some best practices and insights based on the provided sources:

Directory Structure: Organize your project into a clear and logical directory structure. This typically includes separating your application logic (controllers, models) from your public-facing files (views, assets). A suggested structure could be:
public/: Contains all publicly accessible files (e.g., index.php, assets like CSS, JavaScript, and images).
src/: Contains the application's source code, including:
controllers/: Contains controller classes.
models/: Contains model classes.
views/: Contains view templates.
routes/: Contains routing logic.
classes/: Contains utility classes or libraries.
config/: Contains configuration files.
tests/: Contains test code.
vendor/: Contains third-party libraries installed via Composer.
logs/: Contains application logs.
uploads/: Contains uploaded files 1.
Autoloading: Use Composer's autoloading feature to automatically load your classes. This is particularly useful in larger projects where manually including files can become cumbersome. Configure your composer.json file to autoload classes from the src/ directory 13.
Routing: Implement a routing system that maps URLs to specific controller actions. This can be done by parsing the request URI and matching it against a set of predefined routes. Each route can then be associated with a specific controller action 1.
Controllers: Controllers should handle the logic of your application. They receive input from the user, interact with the model to retrieve or store data, and then pass this data to the view for rendering. Controllers should be kept as thin as possible, with most of the business logic residing in the model 12.
Models: Models represent the data and the rules that govern access to and updates of this data. They should handle all database interactions and business logic related to the data. Keeping your models separate from your controllers and views helps maintain a clean separation of concerns 12.
Views: Views are responsible for rendering the user interface. They should contain minimal logic and primarily focus on displaying data. In a PHP MVC application, views are typically PHP files that output HTML, with minimal PHP logic 12.
Global Configuration: Consider using a global configuration file or a bootstrap file that is included at the start of your application. This file can set up global configurations, start sessions, and include any other necessary setup code 1.
Error Handling: Implement robust error handling to manage exceptions and errors gracefully. This includes handling database errors, validation errors, and other unexpected issues that may arise during the execution of your application 3.
Security: Ensure that your application is secure by implementing best practices such as input validation, output escaping, and using prepared statements for database queries to prevent SQL injection attacks 3.
Documentation: Document your codebase thoroughly. This includes inline comments in your code, as well as external documentation that explains the architecture and how to contribute to the project.
By following these best practices, you can effectively organize your PHP project using an MVC architecture without relying on a framework. This approach gives you more control over your application's structure and behavior, allowing you to tailor it to your specific needs.