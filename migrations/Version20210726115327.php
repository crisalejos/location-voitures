<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726115327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars ADD brand_id INT NOT NULL, ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1444F5D008 FOREIGN KEY (brand_id) REFERENCES car_brand (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D147ADA1FB5 FOREIGN KEY (color_id) REFERENCES car_color (id)');
        $this->addSql('CREATE INDEX IDX_95C71D1444F5D008 ON cars (brand_id)');
        $this->addSql('CREATE INDEX IDX_95C71D147ADA1FB5 ON cars (color_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1444F5D008');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D147ADA1FB5');
        $this->addSql('DROP INDEX IDX_95C71D1444F5D008 ON cars');
        $this->addSql('DROP INDEX IDX_95C71D147ADA1FB5 ON cars');
        $this->addSql('ALTER TABLE cars DROP brand_id, DROP color_id');
    }
}
