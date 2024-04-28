<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240427223927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE user (
                id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', 
                name VARCHAR(100) NOT NULL, 
                email VARCHAR(100) NOT NULL, 
                password VARCHAR(100) NOT NULL, 
                created_at DATETIME NOT NULL, 
                updated_at DATETIME NOT NULL, 
                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), 
                INDEX IDX_USER_EMAIL (email), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
