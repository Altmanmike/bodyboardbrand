<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\ReadOnlyTrait;
use App\Entity\OrderFull;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class OrderFullCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;

    #[\Override]
    public static function getEntityFqcn(): string
    {
        return OrderFull::class;
    }

    #[\Override]
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
