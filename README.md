Symfony form tests with CollectionType, ChoiceType (for User roles)
---------
Required :

    - Composer 2.2.x
    - php 8.x
    - Symfony 5.4.x
    - SQLite (for User fixture)

- User Entity (src/Entity/User.php) :
    - id, username, roles, password, email
    - user roles : ROLE_USER, ROLE_ADMIN_APP, ROLE_ADMIN_PROJECT, ROLE_ADMIN


- User fixture (src/DataFixtures/UserFixtures.php) :
    - bin/console doctrine:fixture:load


- Form class (src/Form/UserType.php) :
    - roles with CollectionType and ChoiceType classes


- Unique controller (src/Controller/DefaultController.php) :
    - actions :
        - index '/'
        - new user '/new'
        - edit user '/edit/{id}'


- Templates :
    - index (templates/default/index.html.twig) with a unique form (templates/default/form.html.twig)

To run this project :

```
composer install
bin/console doctrine:migration:migrate
bin/console doctrine:fixture:load

php -S localhost:8000 -t public
```

Sources : 

Security : https://symfony.com/doc/current/security.html

Form : https://symfony.com/doc/current/forms.html

CollectionType field : https://symfony.com/doc/current/reference/forms/types/collection.html

ChoiceType field : https://symfony.com/doc/current/reference/forms/types/choice.html

The Difference between Data Transformers and Mappers : https://symfony.com/doc/current/form/data_mappers.html#the-difference-between-data-transformers-and-mappers