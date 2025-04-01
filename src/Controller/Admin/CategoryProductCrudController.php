<?php

namespace App\Controller\Admin;

use App\Entity\CategoryProduct;
use App\Controller\Admin\Trait\ReadOnlyTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

final class CategoryProductCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;
    
    public static function getEntityFqcn(): string
    {
        return CategoryProduct::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),            
            TextEditorField::new('description'),            
            DateField::new('created_at'),
            DateField::new('updated_at'),
        ];
    }
}
