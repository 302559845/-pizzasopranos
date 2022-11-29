<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129103938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993986C8A81A9');
        $this->addSql('ALTER TABLE `order` ADD adress VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD amount INT NOT NULL, ADD pizza_size VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_f52993986c8a81a9 ON `order`');
        $this->addSql('CREATE INDEX IDX_34E8BC9C6C8A81A9 ON `order` (products_id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993986C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Order` DROP FOREIGN KEY FK_34E8BC9C6C8A81A9');
        $this->addSql('ALTER TABLE `Order` DROP adress, DROP status, DROP amount, DROP pizza_size');
        $this->addSql('DROP INDEX idx_34e8bc9c6c8a81a9 ON `Order`');
        $this->addSql('CREATE INDEX IDX_F52993986C8A81A9 ON `Order` (products_id)');
        $this->addSql('ALTER TABLE `Order` ADD CONSTRAINT FK_34E8BC9C6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
    }
}
