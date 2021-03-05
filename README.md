#Projet MIAGE sur Symfony

##Pour installer le Projet:
> - Clonage du projet sur la machine : git clone https://gitlab.com/miage-symfony/miage-symfony.git
> - Installation des different bundle : `composer install`
> - ####Configuration de la base de donnée:
>   - Dans le ficheir `.env` modifier la ligne `DATABASE_URL`
>   - Creer la base de donnée : `symfony console doctrine:database:create`
>   - Effectuer les migration des entités vers la bdd : `symfony console doctrine:migrations:migrate`
>   - Si problème dans le dossier migrations supprimer les migration (prevenir les autres membre du projet) et faire la commande : `symfony console make:migration` et refaire la dernière commande
>   - Si difiiculter avec l'installation de la bdd : https://symfony.com/doc/current/doctrine.html
>   - Injecter les fixtures dans la bdd : `symfony console doctrine:fixtures:load` (todo)
> 

Chris Momar Younes Dénez
