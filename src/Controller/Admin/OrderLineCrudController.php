<?php

namespace App\Controller\Admin;

use App\Entity\OrderLine;
use App\Controller\Admin\Trait\ReadOnlyTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderLineCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;
    
    public static function getEntityFqcn(): string
    {
        return OrderLine::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),          
            IntegerField::new('quantity'),
            NumberField::new('price'),           
            DateField::new('created_at'),
            DateField::new('updated_at'),
        ];
    }
    
}
