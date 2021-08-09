<?php

namespace App\Controller\Admin;

use App\Entity\Imagen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ImagenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Imagen::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
