<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\ReadOnlyTrait;
use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class MemberCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;

    #[\Override]
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    #[\Override]
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('nickname'),
            TextField::new('role'),
            TextField::new('photo'),
            TextField::new('biography'),
            TextField::new('sponsors'),
            TextField::new('instagram'),
            TextField::new('facebook'),
            TextField::new('youtube'),
            IntegerField::new('ranking'),
            DateField::new('join_date'),
        ];
    }
}
