#Projet MIAGE sur Symfony

##Pour installer le Projet:
> - Clonage du projet sur la machine : git clone https://gitlab.com/miage-symfony/miage-symfony.git
> - Installation des different bundle : `symfony composer install`
> - ####Configuration de la base de donnée:
>   - Dans le ficheir `.env` modifier la ligne `DATABASE_URL`
>   - Creer la base de donnée : `symfony console doctrine:database:create`
>   - Effectuer les migration des entités vers la bdd : `symfony console doctrine:migrations:migrate`
>   - Si problème dans le dossier migrations supprimer les migration (prevenir les autres membre du projet) et faire la commande : `symfony console make:migration` et refaire la dernière commande
>   - Si difficultés avec l'installation de la bdd : https://symfony.com/doc/current/doctrine.html
>   - Injecter les fixtures dans la bdd : `symfony console doctrine:fixtures:load` (todo)
> - ####Configuration du projet miage-angular
>   - utiliser la commande `npm install` dans le dossier du projet
>   - utiliser la commande `npm install bootstrap@~4.2.1 --save` pour installer Bootstrap  
>   - Pour afficher la barre de navigation, installer Angular Material Design avec la commande `ng add @angular/material`
>  

Chris Momar Younes Dénez
