<?php

namespace App\Controller\Admin;

use App\Entity\Goal;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class GoalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Goal::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->hideOnForm(),
            NumberField::new('repetition'),
            NumberField::new('weight'),
            AssociationField::new('user'),
            AssociationField::new('exercise'),

        ];

    }
    
}
