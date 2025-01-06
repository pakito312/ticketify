
# Ticketify - Package Laravel pour la gestion de tickets de support

Ticketify est un package Laravel simple et puissant pour gérer les tickets de support client. Il offre un tableau de bord pour l'administrateur, une interface simple pour la gestion des tickets, et des notifications pour l'équipe technique.

## Installation

### Étape 1 : Installation du package

Ajoutez le package à votre projet Laravel via Composer :

```bash
composer require paki/ticketify
```

### Étape 2 : Publication des ressources

Publiez les fichiers de configuration, vues, et migrations :

```bash
php artisan ticketify:install
```

Cette commande va :
- Publier les fichiers de configuration dans `config/ticketify.php`.
- Publier les vues dans `resources/views/vendor/ticketify`.
- Exécuter les migrations pour créer les tables nécessaires dans votre base de données.

### Étape 3 : Configuration

Vous pouvez configurer le package en éditant le fichier `config/ticketify.php` :
- `layout_font` :  Permet de définir le layout principal par défaut de la platforme.
- `layout_admin` : Permet de définir le layout admin par défaut de la platforme.
- `section_admin` : Permet de définir la section où injecter le contenu admin.
- `section_font` : Permet de définir la section où injecter le contenu principal.

## Utilisation

### Côté Client

- Le client peut voir des tickets en accédant à `/tickets/`.
- Les tickets peuvent être suivis et mis à jour par le client.

### Côté Administrateur

- Le tableau de bord de l'administrateur est disponible sur `/admin/dashboard/tickets`.
- L'administrateur peut consulter le nombre total de tickets, le nombre de tickets ouverts, et résolus.
- Les tickets peuvent être consultés, mis à jour et résolus.

## Personnalisation des Vues

Les vues peuvent être personnalisées en remplaçant les fichiers dans `resources/views/vendor/ticketify`. Par défaut, le package utilise une mise en page simple, mais elle peut être facilement adaptée à votre design.

## Commandes Artisan

### `ticketify:install`

Installe le package, publie les ressources et exécute les migrations.

## Tests

Les tests sont inclus dans le package. Vous pouvez tester l'installation avec :

```bash
php artisan test
```

## License

Ticketify est un package open-source sous la licence MIT. Consultez le fichier [LICENSE](LICENSE) pour plus de détails.

