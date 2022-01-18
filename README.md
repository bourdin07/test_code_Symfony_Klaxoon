## Explications

- Il y a un fichier de migration pour mettre a jour la base de données
    - `./dc exec php bin/console doctrine:migrations:migrate -n` pour mettre à jour la base de données
- J'ai utilisé Postman pour tester les API
- la route `/link/all` pour lister tout les liens (method : GET)
- la route `/link/create` pour créer un lien (method : POST)
    - en passant dans le corps de la requete `{"link" : "...le lien..."}`
- la route `/link/delete/{id}` pour supprimer un lien (method : DELETE)

# Simple Symfony Docker starter

You only need `docker` and `docker-compose` installed

## Start server

The following command will start the development server at URL http://127.0.0.1:8000/:

```bash
./dc up # dc is a wrapper around docker-compose that allows services to be run under the current user
```

## Useful commands

```bash
# Composer is installed into the php container, it can be invoked as such:
./dc exec php composer [command]

# This is a Symfony Flex project, you can install any Flex recipe
./dc exec php composer req annotations

# Symfony console
./dc exec php bin/console

# Start the MySQL cli
./dc exec mysql mysql symfony

# Stop all services
./dc down
```
