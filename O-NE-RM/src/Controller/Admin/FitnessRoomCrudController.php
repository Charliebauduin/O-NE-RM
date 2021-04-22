<?php

namespace App\Controller\Admin;

use App\Entity\FitnessRoom;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FitnessRoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FitnessRoom::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->hideOnForm(),
            TextField::new('name'),


        ];
    }
    
}
