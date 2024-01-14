<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240113165042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (category_id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_code VARCHAR(255) NOT NULL, PRIMARY KEY(category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (license_number INT NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(license_number)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (contact_id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (license_number INT AUTO_INCREMENT NOT NULL, contact_id INT DEFAULT NULL, category_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_70E4FA78E7A1254A (contact_id), INDEX IDX_70E4FA7812469DE2 (category_id), PRIMARY KEY(license_number)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCCEC7E7152 FOREIGN KEY (license_number) REFERENCES member (license_number) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (contact_id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA7812469DE2 FOREIGN KEY (category_id) REFERENCES category (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCCEC7E7152');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78E7A1254A');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA7812469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE member');
    }
}
