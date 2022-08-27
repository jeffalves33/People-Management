<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220827161251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE igrejas (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(50) NOT NULL, endereco VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, foto_igreja VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membros (id INT AUTO_INCREMENT NOT NULL, igreja_id INT NOT NULL, nome VARCHAR(50) NOT NULL, cpf VARCHAR(11) NOT NULL, data_nascimento VARCHAR(10) NOT NULL, email VARCHAR(50) DEFAULT NULL, telefone VARCHAR(12) NOT NULL, logradouro VARCHAR(255) DEFAULT NULL, cidade VARCHAR(15) NOT NULL, estado VARCHAR(2) NOT NULL, INDEX IDX_A3A50B16263136B0 (igreja_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membros ADD CONSTRAINT FK_A3A50B16263136B0 FOREIGN KEY (igreja_id) REFERENCES igrejas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membros DROP FOREIGN KEY FK_A3A50B16263136B0');
        $this->addSql('DROP TABLE igrejas');
        $this->addSql('DROP TABLE membros');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
