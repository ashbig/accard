Accard Patient Repository
==========================

Write introduction to accard patient repository installation.

Installation
-------------
To install Accard, the following steps must be taken. Below, you will find a sample set of commands to set up a local install of Accard using MySQL.

1. Create a local database. Typically, local development is done using MySql, however any local database should suffice. While, sqlite should run properly, we do not recommend using it for development.
2. On the command line, change to your working directory.
3. Run `composer create-project accard/accard <app-name> --repository-url=https://accard-dev.med.upenn.edu/satis --stability=dev` ensuring the proper path to your composer install.
3. Follow on-screen prompts for the following items.
    - database_driver (pdo_mysql): Local database driver
    - database_host (127.0.0.1): *
    - database_port (null): *
    - database_name (symfony): *
    - database_user (root): *
    - database_password (null): *
    - accard_database_driver (oci8): Only required for external data access
    - accard_database_host (null): Only required for external data access
    - accard_database_port (1521): Only required for external data access
    - accard_database_name (accdev11g): Only required for external data access
    - accard_database_user (null): Only required for external data access
    - accard_database_password (null): Only required for external data access
    - dag_development_user (null): Your PennKey
    - accard_app_name (change-me-to-something-unique): Typically, application name
    - accard_import_signals ({  }): Data import signals
    - elasticsearch_host (127.0.0.1): Not currently used
    - elasticsearch_port (9200): Not currently used
    - elasticsearch_enabled (false): Not currently used
    - mailer_transport (smtp): Not currently used
    - mailer_host (127.0.0.1): Not currently used
    - mailer_user (null): Not currently used
    - mailer_password (null): Not currently used
    - locale (en): Not currently used
    - secret (ThisTokenIsNotSoSecretChangeIt): 
    - debug_toolbar (false): `true` to enable debug toolbar
    - debug_redirects (false): `true` for redirect debugging
    - use_assetic_controller (false): `true` for Assetic asset management
4. Pay attention and ensure no errors are reported on installation.
5. When prompted if you wish to `remove existing VCS`, type `y` and proceed.
6. Change to newly created app directory.
7. Run database schema creation command.
8. Add your penn key to list of locally allowed users.

Example
--------
To create a local Accard app called "myapp" using MySQL as your database (assumes local root user without password).

```
echo "CREATE DATABASE myapp_dev;" | mysql -u root
composer create-project accard/accard myapp --repository-url=https://accard-dev.med.upenn.edu/satis --stability=dev
cd myapp
bin/console doctrine:schema:create
bin/console dag:user:allow <your-pennkey>
bin/console cache:clear
bin/console server:run
```

This last command will run a local server with the application running; this isn't very stable and it's better to use a real server. Typically, this will be an Apache virtual host. Simply create a local virtual host, and make it's docroot the `web/` directory of the Accard application directory.
