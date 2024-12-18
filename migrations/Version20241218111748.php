<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218111748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `categoryPost` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `categoryProduct` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `categoryTeam` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `categoryVideo` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `innovation` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_705BDF0DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, role VARCHAR(100) DEFAULT NULL, sponsors VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, ranking INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_70E4FA78A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_team (member_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_38688A437597D3FE (member_id), INDEX IDX_38688A43296CD8AE (team_id), PRIMARY KEY(member_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `orderFull` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, total_price DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', completed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4E7D2D04A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `orderLine` (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, order_full_id INT NOT NULL, quantity INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7F164D524584665A (product_id), INDEX IDX_7F164D526CAD5D4D (order_full_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `post` (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5A8A6C8D12469DE2 (category_id), INDEX IDX_5A8A6C8DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `product` (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', colors LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', sizes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', stock INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT NOT NULL, cover VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04ADA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `team` (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C4E0A61F12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, city VARCHAR(100) NOT NULL, zipcode VARCHAR(50) NOT NULL, location VARCHAR(255) NOT NULL, country VARCHAR(100) NOT NULL, department VARCHAR(100) NOT NULL, region VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_login_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `video` (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, user_id INT NOT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CC7DA2C12469DE2 (category_id), INDEX IDX_7CC7DA2CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `innovation` ADD CONSTRAINT FK_705BDF0DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA78A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE member_team ADD CONSTRAINT FK_38688A437597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_team ADD CONSTRAINT FK_38688A43296CD8AE FOREIGN KEY (team_id) REFERENCES `team` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `orderFull` ADD CONSTRAINT FK_4E7D2D04A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `orderLine` ADD CONSTRAINT FK_7F164D524584665A FOREIGN KEY (product_id) REFERENCES `product` (id)');
        $this->addSql('ALTER TABLE `orderLine` ADD CONSTRAINT FK_7F164D526CAD5D4D FOREIGN KEY (order_full_id) REFERENCES `orderFull` (id)');
        $this->addSql('ALTER TABLE `post` ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES `categoryPost` (id)');
        $this->addSql('ALTER TABLE `post` ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `product` ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES `categoryProduct` (id)');
        $this->addSql('ALTER TABLE `product` ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `team` ADD CONSTRAINT FK_C4E0A61F12469DE2 FOREIGN KEY (category_id) REFERENCES `categoryTeam` (id)');
        $this->addSql('ALTER TABLE `video` ADD CONSTRAINT FK_7CC7DA2C12469DE2 FOREIGN KEY (category_id) REFERENCES `categoryVideo` (id)');
        $this->addSql('ALTER TABLE `video` ADD CONSTRAINT FK_7CC7DA2CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `innovation` DROP FOREIGN KEY FK_705BDF0DA76ED395');
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA78A76ED395');
        $this->addSql('ALTER TABLE member_team DROP FOREIGN KEY FK_38688A437597D3FE');
        $this->addSql('ALTER TABLE member_team DROP FOREIGN KEY FK_38688A43296CD8AE');
        $this->addSql('ALTER TABLE `orderFull` DROP FOREIGN KEY FK_4E7D2D04A76ED395');
        $this->addSql('ALTER TABLE `orderLine` DROP FOREIGN KEY FK_7F164D524584665A');
        $this->addSql('ALTER TABLE `orderLine` DROP FOREIGN KEY FK_7F164D526CAD5D4D');
        $this->addSql('ALTER TABLE `post` DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE `post` DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE `product` DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE `product` DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('ALTER TABLE `team` DROP FOREIGN KEY FK_C4E0A61F12469DE2');
        $this->addSql('ALTER TABLE `video` DROP FOREIGN KEY FK_7CC7DA2C12469DE2');
        $this->addSql('ALTER TABLE `video` DROP FOREIGN KEY FK_7CC7DA2CA76ED395');
        $this->addSql('DROP TABLE `categoryPost`');
        $this->addSql('DROP TABLE `categoryProduct`');
        $this->addSql('DROP TABLE `categoryTeam`');
        $this->addSql('DROP TABLE `categoryVideo`');
        $this->addSql('DROP TABLE `innovation`');
        $this->addSql('DROP TABLE `member`');
        $this->addSql('DROP TABLE member_team');
        $this->addSql('DROP TABLE `orderFull`');
        $this->addSql('DROP TABLE `orderLine`');
        $this->addSql('DROP TABLE `post`');
        $this->addSql('DROP TABLE `product`');
        $this->addSql('DROP TABLE `team`');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE `video`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
