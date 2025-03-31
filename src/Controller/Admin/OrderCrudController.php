<?php

namespace App\Controller\Admin;

use App\Entity\OrderFull;
use App\Controller\Admin\Trait\ReadOnlyTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;
    
    public static function getEntityFqcn(): string
    {
        return OrderFull::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),          
            TextField::new('status'),
            NumberField::new('totalPrice'),           
            DateField::new('created_at'),
            DateField::new('updated_at'),
            DateField::new('completed_at'),
        ];
    }
    
}
