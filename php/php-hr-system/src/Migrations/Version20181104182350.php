<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104182350 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_data DROP FOREIGN KEY FK_2A3F85229D86650F');
        $this->addSql('DROP INDEX UNIQ_2A3F85229D86650F ON job_data');
        $this->addSql('ALTER TABLE job_data CHANGE monthly_salary monthly_salary INT NOT NULL, CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_data ADD CONSTRAINT FK_2A3F8522A76ED395 FOREIGN KEY (user_id) REFERENCES personal_data (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A3F8522A76ED395 ON job_data (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_data DROP FOREIGN KEY FK_2A3F8522A76ED395');
        $this->addSql('DROP INDEX UNIQ_2A3F8522A76ED395 ON job_data');
        $this->addSql('ALTER TABLE job_data CHANGE monthly_salary monthly_salary DOUBLE PRECISION NOT NULL, CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_data ADD CONSTRAINT FK_2A3F85229D86650F FOREIGN KEY (user_id_id) REFERENCES personal_data (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A3F85229D86650F ON job_data (user_id_id)');
    }
}
