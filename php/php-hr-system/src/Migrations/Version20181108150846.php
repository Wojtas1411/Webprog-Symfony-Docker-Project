<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181108150846 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE temporary_personal_data (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, user_id VARCHAR(255) NOT NULL, family_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, birth_place VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, adres JSON DEFAULT NULL, emails JSON DEFAULT NULL, phone_numbers JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C81E8521D775834 ON emails (value)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7DC46CB1D775834 ON phone_numbers (value)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE temporary_personal_data');
        $this->addSql('DROP INDEX UNIQ_4C81E8521D775834 ON emails');
        $this->addSql('DROP INDEX UNIQ_E7DC46CB1D775834 ON phone_numbers');
    }
}
