<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\ReadOnlyTrait;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class ProductCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;

    #[\Override]
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    #[\Override]
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextField::new('cover'),
            ArrayField::new('colors'),
            ArrayField::new('sizes'),
            IntegerField::new('stock'),
            NumberField::new('price'),
            TextEditorField::new('description'),
            DateField::new('created_at'),
            DateField::new('updated_at'),
        ];
    }
}
