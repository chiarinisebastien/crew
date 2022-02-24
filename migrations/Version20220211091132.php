<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220211091132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste_tache (id INT AUTO_INCREMENT NOT NULL, helper_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, service_id INT DEFAULT NULL, INDEX IDX_8C7CF4DBD7693E95 (helper_id), INDEX IDX_8C7CF4DB3414710B (agent_id), INDEX IDX_8C7CF4DBED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_tache ADD CONSTRAINT FK_8C7CF4DBD7693E95 FOREIGN KEY (helper_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste_tache ADD CONSTRAINT FK_8C7CF4DB3414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste_tache ADD CONSTRAINT FK_8C7CF4DBED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liste_tache');
    }
}
