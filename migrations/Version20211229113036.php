<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229113036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE manuel ADD categorie1_id INT DEFAULT NULL, ADD categorie2_id INT DEFAULT NULL, ADD categorie3_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE manuel ADD CONSTRAINT FK_74B77BC0930F8401 FOREIGN KEY (categorie1_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE manuel ADD CONSTRAINT FK_74B77BC081BA2BEF FOREIGN KEY (categorie2_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE manuel ADD CONSTRAINT FK_74B77BC039064C8A FOREIGN KEY (categorie3_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_74B77BC0930F8401 ON manuel (categorie1_id)');
        $this->addSql('CREATE INDEX IDX_74B77BC081BA2BEF ON manuel (categorie2_id)');
        $this->addSql('CREATE INDEX IDX_74B77BC039064C8A ON manuel (categorie3_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE manuel DROP FOREIGN KEY FK_74B77BC0930F8401');
        $this->addSql('ALTER TABLE manuel DROP FOREIGN KEY FK_74B77BC081BA2BEF');
        $this->addSql('ALTER TABLE manuel DROP FOREIGN KEY FK_74B77BC039064C8A');
        $this->addSql('DROP INDEX IDX_74B77BC0930F8401 ON manuel');
        $this->addSql('DROP INDEX IDX_74B77BC081BA2BEF ON manuel');
        $this->addSql('DROP INDEX IDX_74B77BC039064C8A ON manuel');
        $this->addSql('ALTER TABLE manuel DROP categorie1_id, DROP categorie2_id, DROP categorie3_id');
    }
}
