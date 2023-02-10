<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('username')->setLabel('Utilisateur'),
           // Field::new('roles'),
            Field::new('password')->setLabel('Mot de passe')->hideOnIndex(),
            // Roles
            ChoiceField::new('roles')->setChoices([
                'Administrateur' => 'ROLE_ADMIN',
                'Utilisateur' => 'ROLE_USER',
            ])->allowMultipleChoices(),
        ];
    }

}
