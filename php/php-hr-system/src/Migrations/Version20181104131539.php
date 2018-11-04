<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104131539 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emails CHANGE owner_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE emails ADD CONSTRAINT FK_4C81E852A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C81E852A76ED395 ON emails (user_id)');
        $this->addSql('ALTER TABLE adres CHANGE owner_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_50C7CAEEA76ED395 ON adres (user_id)');
        $this->addSql('ALTER TABLE phone_numbers CHANGE owner_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE phone_numbers ADD CONSTRAINT FK_E7DC46CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E7DC46CBA76ED395 ON phone_numbers (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEA76ED395');
        $this->addSql('DROP INDEX IDX_50C7CAEEA76ED395 ON adres');
        $this->addSql('ALTER TABLE adres CHANGE user_id owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE emails DROP FOREIGN KEY FK_4C81E852A76ED395');
        $this->addSql('DROP INDEX IDX_4C81E852A76ED395 ON emails');
        $this->addSql('ALTER TABLE emails CHANGE user_id owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE phone_numbers DROP FOREIGN KEY FK_E7DC46CBA76ED395');
        $this->addSql('DROP INDEX IDX_E7DC46CBA76ED395 ON phone_numbers');
        $this->addSql('ALTER TABLE phone_numbers CHANGE user_id owner_id INT NOT NULL');
    }
}
