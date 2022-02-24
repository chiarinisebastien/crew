<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220211133105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_tache ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_tache ADD CONSTRAINT FK_8C7CF4DBE85441D8 FOREIGN KEY (liste_id) REFERENCES nom_liste_tache (id)');
        $this->addSql('CREATE INDEX IDX_8C7CF4DBE85441D8 ON liste_tache (liste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_tache DROP FOREIGN KEY FK_8C7CF4DBE85441D8');
        $this->addSql('DROP INDEX IDX_8C7CF4DBE85441D8 ON liste_tache');
        $this->addSql('ALTER TABLE liste_tache DROP liste_id');
    }
}
