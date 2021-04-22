<?php

namespace App\Controller\Admin;

use App\Entity\Progress;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProgressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Progress::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        return [

            IdField::new('id')->hideOnForm(),
            DateTimeField::new('date'),
            NumberField::new('repetition'),
            NumberField::new('weight'),
            AssociationField::new('user'),
            AssociationField::new('exercise'),

        ];

    }
    
}
