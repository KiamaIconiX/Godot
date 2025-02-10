<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250209223135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP temps_cuisson');
        $this->addSql('ALTER TABLE plat DROP prix');
        $this->addSql('ALTER TABLE recette DROP CONSTRAINT fk_49bb63903ec4dce');
        $this->addSql('DROP INDEX idx_49bb63903ec4dce');
        $this->addSql('ALTER TABLE recette RENAME COLUMN ingredients_id TO ingredient_id');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_49BB6390933FE08C ON recette (ingredient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recette DROP CONSTRAINT FK_49BB6390933FE08C');
        $this->addSql('DROP INDEX IDX_49BB6390933FE08C');
        $this->addSql('ALTER TABLE recette RENAME COLUMN ingredient_id TO ingredients_id');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT fk_49bb63903ec4dce FOREIGN KEY (ingredients_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_49bb63903ec4dce ON recette (ingredients_id)');
        $this->addSql('ALTER TABLE plat ADD temps_cuisson INT NOT NULL');
        $this->addSql('ALTER TABLE plat ADD prix INT NOT NULL');
    }
}
