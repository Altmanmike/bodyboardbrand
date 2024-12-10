<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use App\Controller\Admin\Trait\ReadOnlyTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MemberCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;
    
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }
    
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
