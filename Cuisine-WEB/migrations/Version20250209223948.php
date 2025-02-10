<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250209223948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande0 (id SERIAL NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE plat ADD temps_cuisson INT NOT NULL');
        $this->addSql('ALTER TABLE plat ADD prix INT NOT NULL');
        $this->addSql('ALTER TABLE recette DROP CONSTRAINT fk_49bb6390933fe08c');
        $this->addSql('DROP INDEX idx_49bb6390933fe08c');
        $this->addSql('ALTER TABLE recette RENAME COLUMN ingredient_id TO ingredients_id');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63903EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_49BB63903EC4DCE ON recette (ingredients_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE commande0');
        $this->addSql('ALTER TABLE recette DROP CONSTRAINT FK_49BB63903EC4DCE');
        $this->addSql('DROP INDEX IDX_49BB63903EC4DCE');
        $this->addSql('ALTER TABLE recette RENAME COLUMN ingredients_id TO ingredient_id');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT fk_49bb6390933fe08c FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_49bb6390933fe08c ON recette (ingredient_id)');
        $this->addSql('ALTER TABLE plat DROP temps_cuisson');
        $this->addSql('ALTER TABLE plat DROP prix');
    }
}
