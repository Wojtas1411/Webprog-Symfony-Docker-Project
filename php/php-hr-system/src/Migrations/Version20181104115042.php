<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104115042 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emails DROP FOREIGN KEY emails_ibfk_1');
        $this->addSql('DROP INDEX owner_id ON emails');
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY adres_ibfk_1');
        $this->addSql('DROP INDEX owner_id ON adres');
        $this->addSql('ALTER TABLE phone_numbers DROP FOREIGN KEY phone_numbers_ibfk_1');
        $this->addSql('DROP INDEX owner_id ON phone_numbers');
        $this->addSql('ALTER TABLE engagement ADD CONSTRAINT FK_D86F0141E3742DB0 FOREIGN KEY (staff_category_id) REFERENCES staff_category (id)');
        $this->addSql('ALTER TABLE engagement ADD CONSTRAINT FK_D86F0141217BBB47 FOREIGN KEY (person_id) REFERENCES personal_data (id)');
        $this->addSql('CREATE INDEX IDX_D86F0141E3742DB0 ON engagement (staff_category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D86F0141217BBB47 ON engagement (person_id)');
        $this->addSql('ALTER TABLE membership CHANGE working_hours_weekly working_hours_per_week INT NOT NULL');
        $this->addSql('ALTER TABLE membership ADD CONSTRAINT FK_86FFD285217BBB47 FOREIGN KEY (person_id) REFERENCES personal_data (id)');
        $this->addSql('ALTER TABLE membership ADD CONSTRAINT FK_86FFD285F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
        $this->addSql('CREATE INDEX IDX_86FFD285217BBB47 ON membership (person_id)');
        $this->addSql('CREATE INDEX IDX_86FFD285F8BD700D ON membership (unit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adres ADD CONSTRAINT adres_ibfk_1 FOREIGN KEY (owner_id) REFERENCES personal_data (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX owner_id ON adres (owner_id)');
        $this->addSql('ALTER TABLE emails ADD CONSTRAINT emails_ibfk_1 FOREIGN KEY (owner_id) REFERENCES personal_data (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX owner_id ON emails (owner_id)');
        $this->addSql('ALTER TABLE engagement DROP FOREIGN KEY FK_D86F0141E3742DB0');
        $this->addSql('ALTER TABLE engagement DROP FOREIGN KEY FK_D86F0141217BBB47');
        $this->addSql('DROP INDEX IDX_D86F0141E3742DB0 ON engagement');
        $this->addSql('DROP INDEX UNIQ_D86F0141217BBB47 ON engagement');
        $this->addSql('ALTER TABLE membership DROP FOREIGN KEY FK_86FFD285217BBB47');
        $this->addSql('ALTER TABLE membership DROP FOREIGN KEY FK_86FFD285F8BD700D');
        $this->addSql('DROP INDEX IDX_86FFD285217BBB47 ON membership');
        $this->addSql('DROP INDEX IDX_86FFD285F8BD700D ON membership');
        $this->addSql('ALTER TABLE membership CHANGE working_hours_per_week working_hours_weekly INT NOT NULL');
        $this->addSql('ALTER TABLE phone_numbers ADD CONSTRAINT phone_numbers_ibfk_1 FOREIGN KEY (owner_id) REFERENCES personal_data (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX owner_id ON phone_numbers (owner_id)');
    }
}
