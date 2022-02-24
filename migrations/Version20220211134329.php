<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220211134329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_tache DROP FOREIGN KEY FK_8C7CF4DB3414710B');
        $this->addSql('DROP INDEX IDX_8C7CF4DB3414710B ON liste_tache');
        $this->addSql('ALTER TABLE liste_tache DROP agent_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_tache ADD agent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_tache ADD CONSTRAINT FK_8C7CF4DB3414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8C7CF4DB3414710B ON liste_tache (agent_id)');
    }
}
