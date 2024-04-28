<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240428125619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates message table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE message (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', 
            eventId VARCHAR(100) NOT NULL, 
            eventName VARCHAR(100) NOT NULL, 
            attributes JSON NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            UNIQUE INDEX UNIQ_B6BD307F2B2EBB6C (eventId), 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE message');
    }
}
