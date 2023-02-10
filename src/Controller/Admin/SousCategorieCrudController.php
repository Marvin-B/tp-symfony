<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\SousCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class SousCategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SousCategorie::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield  Field::new('id')->setLabel('ID')->hideOnForm(),
            yield Field::new('nom')->setLabel('Nom'),
            yield AssociationField::new('categorie')->renderAsNativeWidget(Categorie::class),
        ];
    }

}
