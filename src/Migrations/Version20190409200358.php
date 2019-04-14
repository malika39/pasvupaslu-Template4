<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409200358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE editeur ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE category name_category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE imagesadmin DROP FOREIGN KEY FK_2EE46396F26E0AE7');
        $this->addSql('ALTER TABLE imagesadmin DROP FOREIGN KEY FK_2EE463963375BD21');
        $this->addSql('DROP INDEX IDX_2EE46396F26E0AE7 ON imagesadmin');
        $this->addSql('ALTER TABLE imagesadmin CHANGE inter_view_id interView_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE imagesadmin ADD CONSTRAINT FK_2EE463969A6BA409 FOREIGN KEY (interView_id) REFERENCES interView (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE imagesadmin ADD CONSTRAINT FK_2EE463963375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_2EE463969A6BA409 ON imagesadmin (interView_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE name_category category VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE editeur DROP deleted_at');
        $this->addSql('ALTER TABLE imagesAdmin DROP FOREIGN KEY FK_2EE463969A6BA409');
        $this->addSql('ALTER TABLE imagesAdmin DROP FOREIGN KEY FK_2EE463963375BD21');
        $this->addSql('DROP INDEX IDX_2EE463969A6BA409 ON imagesAdmin');
        $this->addSql('ALTER TABLE imagesAdmin CHANGE interview_id inter_view_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE imagesAdmin ADD CONSTRAINT FK_2EE46396F26E0AE7 FOREIGN KEY (inter_view_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE imagesAdmin ADD CONSTRAINT FK_2EE463963375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_2EE46396F26E0AE7 ON imagesAdmin (inter_view_id)');
    }
}
