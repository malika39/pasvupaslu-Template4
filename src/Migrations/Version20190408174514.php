<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408174514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE editeur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, post_code INT NOT NULL, phone VARCHAR(15) DEFAULT NULL, country VARCHAR(255) NOT NULL, function VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE child_comment (id INT AUTO_INCREMENT NOT NULL, comment_id INT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_F6C01A77F8697D13 (comment_id), INDEX IDX_F6C01A77A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, livre_id INT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, rate INT NOT NULL, createAt DATETIME NOT NULL, INDEX IDX_9474526C37D925CB (livre_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, alt VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE imagesAdmin (id INT AUTO_INCREMENT NOT NULL, editeur_id INT DEFAULT NULL, inter_view_id INT DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_2EE463963375BD21 (editeur_id), INDEX IDX_2EE46396F26E0AE7 (inter_view_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE interView (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, post_code INT NOT NULL, phone VARCHAR(15) DEFAULT NULL, country VARCHAR(255) NOT NULL, function LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE livres (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, extract LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_927187A4BCF5E72D (categorie_id), INDEX IDX_927187A4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, age INT NOT NULL, photo VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, code_postale INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, UNIQUE INDEX UNIQ_85CBC6ABA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, editeur_id INT NOT NULL, inter_view_id INT NOT NULL, name VARCHAR(191) NOT NULL, $content VARCHAR(255) NOT NULL, response LONGTEXT NOT NULL, INDEX IDX_B6F7494E3375BD21 (editeur_id), INDEX IDX_B6F7494EF26E0AE7 (inter_view_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, date_registration DATETIME NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_comment ADD CONSTRAINT FK_F6C01A77F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE child_comment ADD CONSTRAINT FK_F6C01A77A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C37D925CB FOREIGN KEY (livre_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE imagesAdmin ADD CONSTRAINT FK_2EE463963375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE imagesAdmin ADD CONSTRAINT FK_2EE46396F26E0AE7 FOREIGN KEY (inter_view_id) REFERENCES interView (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profil_user ADD CONSTRAINT FK_85CBC6ABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF26E0AE7 FOREIGN KEY (inter_view_id) REFERENCES interView (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE imagesAdmin DROP FOREIGN KEY FK_2EE463963375BD21');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E3375BD21');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4BCF5E72D');
        $this->addSql('ALTER TABLE child_comment DROP FOREIGN KEY FK_F6C01A77F8697D13');
        $this->addSql('ALTER TABLE imagesAdmin DROP FOREIGN KEY FK_2EE46396F26E0AE7');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF26E0AE7');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C37D925CB');
        $this->addSql('ALTER TABLE child_comment DROP FOREIGN KEY FK_F6C01A77A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4A76ED395');
        $this->addSql('ALTER TABLE profil_user DROP FOREIGN KEY FK_85CBC6ABA76ED395');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE child_comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE imagesAdmin');
        $this->addSql('DROP TABLE interView');
        $this->addSql('DROP TABLE livres');
        $this->addSql('DROP TABLE profil_user');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE user');
    }
}
