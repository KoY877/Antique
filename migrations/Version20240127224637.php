<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127224637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat_category DROP FOREIGN KEY FK_38A53F9A12469DE2');
        $this->addSql('ALTER TABLE plat_category DROP FOREIGN KEY FK_38A53F9AD73DB560');
        $this->addSql('DROP TABLE plat_category');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207A21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2038A207A21214B7 ON plat (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plat_category (plat_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_38A53F9AD73DB560 (plat_id), INDEX IDX_38A53F9A12469DE2 (category_id), PRIMARY KEY(plat_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE plat_category ADD CONSTRAINT FK_38A53F9A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_category ADD CONSTRAINT FK_38A53F9AD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207A21214B7');
        $this->addSql('DROP INDEX IDX_2038A207A21214B7 ON plat');
    }
}
