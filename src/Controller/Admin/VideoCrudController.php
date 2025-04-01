<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\ReadOnlyTrait;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class VideoCrudController extends AbstractCrudController
{
    use ReadOnlyTrait;

    #[\Override]
    public static function getEntityFqcn(): string
    {
        return Video::class;
    }

    #[\Override]
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('url'),
            TextField::new('title'),
            TextEditorField::new('description'),
            DateField::new('created_at'),
            DateField::new('updated_at'),
        ];
    }
}
