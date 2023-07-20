# Interview assignment

The goal of the test is to demonstrate knowledge of the PHP and Laravel framework, together with basic knowledge of javascript and (s)css.

Additionally, following best practices for clean code and architecture is desirable.

## How to set up the project

To run the project locally, you will need PHP 8.1 and composer installed.
Also, the docker service should be installed and running.

When you ensure that all requirements are installed and running,
run the following commands (or equivalent, depending on your OS setup):

```shell
composer install
vendor/bin/sail up -d
vendor/bin/sail artisan migrate
vendor/bin/sail artisan db:seed
vendor/bin/sail npm install
vendor/bin/sail npm run build
```

After that you can run following command to watch js/css changes:
```
vendor/bin/sail npm run dev
```
This will populate the database with data needed for assignment and will make a project visible on [http://localhost](http://localhost).

The page needed for this assignment is at [http://localhost/test](http://localhost/test), and login is available at [http://localhost/login](http://localhost/login).


## The existing code

The controller and the template for test page are set up for the task already (including calls to the missing component which should be implemented) and should be used as is.

Beside that, basic login page is provided together with fake users which can be used for testing. 

The password for all generated users is **password**. Emails are randomly generated and can be seen in the database after project setup.

## The goal

Finishing this assignment requires completing two tasks inside this project and sending this directory to the reviewer.

The expected result is two top lists visible at [http://localhost/test](http://localhost/test), generated using parameters set in the template and using rules described in tasks below.

If you need to add additional comments or instructions, you can put them in the [COMMENTS.md](COMMENTS.md) file.

### Task 1

Create the artisan command named "app:redis:populate" which should use data from the MySQL database to populate Redis.

After population Redis should contain:
 * JSON data for game and casino cards. Data in the cards should be in the same format for game and casino cards. Every card should have it's unique key.
 * Precalculated card order for every available market (for example sorting info for US market), and order of the cards globally (ignoring market filtering). Cards should be sorted by rank for casinos and number of plays for games, both in descending order.

### Task 2

Create the top list component named x-top-list, which is called in [resources/views/test.blade.php](resources/views/test.blade.php).

The component should accept three arguments:
 * Type of the top list (argument **for**) which should accept _game_ or _casino_ values. This argument is **required**
 * Maximum number of items showed in the top list (argument **count**). This argument is **optional** and the default value should be 10.
 * Number of cards initially showed (argument **visible-count**). This argument is **optional** and the default value should be 5.

The component should render cards following this rules:
 * The top list contain a multi-item carousel (example of the same component done in the bootstrap can be seen [here](https://bootsnipp.com/snippets/zDQkr)), initially rendering the number of cards as specified in **visible-count** argument.
 * Every card should contain the title, an image and a button.
 * The title of the card should be casino/game name.
 * The card image should be a casino logo or a game screenshot.
 * Button text should be "visit" and clicking on it should go to casino/game url.
 * In case the user is not logged in, it should render cards using global order (ignoring the market).
 * In case the user is logged in, it should try to render cards in order for the market corresponding to users country field in the database. In case the market is not present, it should order them in a same way as when user is not logged in.
 * In case the available number of cards is less than maximum number from the **count** argument, render as much cards as available.
