<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104133109 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emails DROP FOREIGN KEY FK_4C81E852A76ED395');
        $this->addSql('ALTER TABLE emails ADD CONSTRAINT FK_4C81E852A76ED395 FOREIGN KEY (user_id) REFERENCES personal_data (id)');
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEA76ED395');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEA76ED395 FOREIGN KEY (user_id) REFERENCES personal_data (id)');
        $this->addSql('ALTER TABLE phone_numbers DROP FOREIGN KEY FK_E7DC46CBA76ED395');
        $this->addSql('ALTER TABLE phone_numbers ADD CONSTRAINT FK_E7DC46CBA76ED395 FOREIGN KEY (user_id) REFERENCES personal_data (id)');
        $this->addSql('ALTER TABLE units ADD CONSTRAINT FK_E9B07449727ACA70 FOREIGN KEY (parent_id) REFERENCES units (id)');
        $this->addSql('ALTER TABLE units ADD CONSTRAINT FK_E9B07449261FB672 FOREIGN KEY (boss_id) REFERENCES personal_data (id)');
        $this->addSql('CREATE INDEX IDX_E9B07449727ACA70 ON units (parent_id)');
        $this->addSql('CREATE INDEX IDX_E9B07449261FB672 ON units (boss_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEA76ED395');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE emails DROP FOREIGN KEY FK_4C81E852A76ED395');
        $this->addSql('ALTER TABLE emails ADD CONSTRAINT FK_4C81E852A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE phone_numbers DROP FOREIGN KEY FK_E7DC46CBA76ED395');
        $this->addSql('ALTER TABLE phone_numbers ADD CONSTRAINT FK_E7DC46CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE units DROP FOREIGN KEY FK_E9B07449727ACA70');
        $this->addSql('ALTER TABLE units DROP FOREIGN KEY FK_E9B07449261FB672');
        $this->addSql('DROP INDEX IDX_E9B07449727ACA70 ON units');
        $this->addSql('DROP INDEX IDX_E9B07449261FB672 ON units');
    }
}
