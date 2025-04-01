<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Controller\Admin\Trait\ReadOnlyTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

final class PostCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;
    
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextField::new('image'),
            TextEditorField::new('content'),
            TextField::new('author'),
            DateField::new('created_at'),
            DateField::new('updated_at'),
        ];
    }    
}
