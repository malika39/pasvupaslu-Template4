<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413180917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF26E0AE7');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E3375BD21');
        $this->addSql('DROP INDEX IDX_B6F7494EF26E0AE7 ON question');
        $this->addSql('ALTER TABLE question CHANGE inter_view_id interView_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E9A6BA409 FOREIGN KEY (interView_id) REFERENCES interView (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B6F7494E9A6BA409 ON question (interView_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E9A6BA409');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E3375BD21');
        $this->addSql('DROP INDEX IDX_B6F7494E9A6BA409 ON question');
        $this->addSql('ALTER TABLE question CHANGE interview_id inter_view_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF26E0AE7 FOREIGN KEY (inter_view_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EF26E0AE7 ON question (inter_view_id)');
    }
}
