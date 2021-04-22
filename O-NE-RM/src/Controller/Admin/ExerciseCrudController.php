<?php

namespace App\Controller\Admin;

use App\Entity\Exercise;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExerciseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercise::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            NumberField::new('difficulty'),
            TextField::new('illustration'),
            TextField::new('advice')
        ];
    }
    
}
