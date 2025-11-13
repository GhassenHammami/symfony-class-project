# Symfony Job Candidature Project

A simple Symfony project to manage images (CRUD) for a job application. Built with Symfony, Doctrine, and Twig.

## Setup

### 1. Install dependencies
Install PHP packages required for the project.

```bash
composer install
```

### 2. Create the database
Creates the database configured in your .env file.

```bash
php bin/console doctrine:database:create
```

### 3. Create an entity
Generate a new Doctrine entity with fields.

```bash
php bin/console make:entity
```

### 4. Generate a migration
Create a migration file for your entity changes.

```bash
php bin/console make:migration
```

### 5. Apply migrations
Run the migration to update your database schema.

```bash
php bin/console doctrine:migrations:migrate
```
### 6. Generate CRUD
Automatically generate a CRUD interface for an entity.

```bash
php bin/console make:crud
```

### 7. Start Symfony server
Launch the local development server.

```bash
symfony server:start
```

## Useful Commands
### Show routes
Display all registered routes.

```bash
php bin/console debug:router
```

### Clear cache
Clear Symfony cache to reflect changes immediately.

```bash
php bin/console cache:clear
```

### Validate database schema
Check if your database schema matches your entities.
```bash
php bin/console doctrine:schema:validate
```