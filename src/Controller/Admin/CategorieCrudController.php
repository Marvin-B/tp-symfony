<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->setLabel('ID')->hideOnForm(),
            Field::new('nom')->setLabel('Nom'),
        ];
    }

}
