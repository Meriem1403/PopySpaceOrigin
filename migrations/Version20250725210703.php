<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250725210703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955A9CFCB36');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955A9CFCB36 FOREIGN KEY (planete_id) REFERENCES planete (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955A9CFCB36');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955A9CFCB36 FOREIGN KEY (planete_id) REFERENCES planete (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
