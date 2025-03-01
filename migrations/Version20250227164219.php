<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227164219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, forum_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DADD4A25F675F31B (author_id), INDEX IDX_DADD4A2529CCBAD0 (forum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_course (category_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_1976A5C212469DE2 (category_id), INDEX IDX_1976A5C2591CC992 (course_id), PRIMARY KEY(category_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, course_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composer (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, biography LONGTEXT NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composer_instrument (composer_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_D23DB0487A8D2620 (composer_id), INDEX IDX_D23DB048CF11D9C (instrument_id), PRIMARY KEY(composer_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, user_one_id INT NOT NULL, user_two_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8A8E26E99EC8D52E (user_one_id), INDEX IDX_8A8E26E9F59432E1 (user_two_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, professor_id INT NOT NULL, instrument_id INT DEFAULT NULL, image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION DEFAULT NULL, rating_score INT DEFAULT NULL, files LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', link_video VARCHAR(255) NOT NULL, preview LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_169E6FB97D2D84D5 (professor_id), INDEX IDX_169E6FB9CF11D9C (instrument_id), UNIQUE INDEX UNIQ_169E6FB93DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_composer (course_id INT NOT NULL, composer_id INT NOT NULL, INDEX IDX_31C76B8E591CC992 (course_id), INDEX IDX_31C76B8E7A8D2620 (composer_id), PRIMARY KEY(course_id, composer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_reference (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, filename VARCHAR(255) NOT NULL, original_filename VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, INDEX IDX_2C0209BF591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, subject VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT DEFAULT NULL, INDEX IDX_852BBECDF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_category (forum_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_21BF942629CCBAD0 (forum_id), INDEX IDX_21BF942612469DE2 (category_id), PRIMARY KEY(forum_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_forum_like (forum_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C8E5268829CCBAD0 (forum_id), INDEX IDX_C8E52688A76ED395 (user_id), PRIMARY KEY(forum_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_forum_dislike (forum_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E1790C8B29CCBAD0 (forum_id), INDEX IDX_E1790C8BA76ED395 (user_id), PRIMARY KEY(forum_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE histo_quizz (id INT AUTO_INCREMENT NOT NULL, score INT DEFAULT NULL, date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE histo_quizz_user (histo_quizz_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_57487227A8C00FE5 (histo_quizz_id), INDEX IDX_57487227A76ED395 (user_id), PRIMARY KEY(histo_quizz_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE histo_quizz_quizz (histo_quizz_id INT NOT NULL, quizz_id INT NOT NULL, INDEX IDX_D6A700C6A8C00FE5 (histo_quizz_id), INDEX IDX_D6A700C6BA934BCD (quizz_id), PRIMARY KEY(histo_quizz_id, quizz_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, conversation_id INT NOT NULL, content_text LONGTEXT NOT NULL, sent_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307FF675F31B (author_id), INDEX IDX_B6BD307F9AC0396 (conversation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progression (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, course_id INT DEFAULT NULL, video_timestamp VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', percentage_watched INT DEFAULT NULL, status VARCHAR(255) NOT NULL, quizz_status VARCHAR(255) DEFAULT NULL, INDEX IDX_D5B25073A76ED395 (user_id), INDEX IDX_D5B25073591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quizz_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6F7494EBA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7C77973D591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, user_id INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_D8892622591CC992 (course_id), INDEX IDX_D8892622A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, content_text LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_794381C6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suggest (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, content LONGTEXT NOT NULL, response_expected TINYINT(1) DEFAULT NULL, INDEX IDX_8B867B861E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, subscription_id INT DEFAULT NULL, image_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', biography LONGTEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D6499A1887DC (subscription_id), UNIQUE INDEX UNIQ_8D93D6493DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_course (user_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_73CC7484A76ED395 (user_id), INDEX IDX_73CC7484591CC992 (course_id), PRIMARY KEY(user_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_instrument (user_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_9BD8AF31A76ED395 (user_id), INDEX IDX_9BD8AF31CF11D9C (instrument_id), PRIMARY KEY(user_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A2529CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('ALTER TABLE category_course ADD CONSTRAINT FK_1976A5C212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_course ADD CONSTRAINT FK_1976A5C2591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE composer_instrument ADD CONSTRAINT FK_D23DB0487A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composer_instrument ADD CONSTRAINT FK_D23DB048CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E99EC8D52E FOREIGN KEY (user_one_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9F59432E1 FOREIGN KEY (user_two_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB97D2D84D5 FOREIGN KEY (professor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB93DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE course_composer ADD CONSTRAINT FK_31C76B8E591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_composer ADD CONSTRAINT FK_31C76B8E7A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_reference ADD CONSTRAINT FK_2C0209BF591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECDF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_category ADD CONSTRAINT FK_21BF942629CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_category ADD CONSTRAINT FK_21BF942612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_forum_like ADD CONSTRAINT FK_C8E5268829CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_forum_like ADD CONSTRAINT FK_C8E52688A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_forum_dislike ADD CONSTRAINT FK_E1790C8B29CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_forum_dislike ADD CONSTRAINT FK_E1790C8BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE histo_quizz_user ADD CONSTRAINT FK_57487227A8C00FE5 FOREIGN KEY (histo_quizz_id) REFERENCES histo_quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE histo_quizz_user ADD CONSTRAINT FK_57487227A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE histo_quizz_quizz ADD CONSTRAINT FK_D6A700C6A8C00FE5 FOREIGN KEY (histo_quizz_id) REFERENCES histo_quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE histo_quizz_quizz ADD CONSTRAINT FK_D6A700C6BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id)');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973D591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE suggest ADD CONSTRAINT FK_8B867B861E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE user_course ADD CONSTRAINT FK_73CC7484A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_course ADD CONSTRAINT FK_73CC7484591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instrument ADD CONSTRAINT FK_9BD8AF31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instrument ADD CONSTRAINT FK_9BD8AF31CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25F675F31B');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2529CCBAD0');
        $this->addSql('ALTER TABLE category_course DROP FOREIGN KEY FK_1976A5C212469DE2');
        $this->addSql('ALTER TABLE category_course DROP FOREIGN KEY FK_1976A5C2591CC992');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C591CC992');
        $this->addSql('ALTER TABLE composer_instrument DROP FOREIGN KEY FK_D23DB0487A8D2620');
        $this->addSql('ALTER TABLE composer_instrument DROP FOREIGN KEY FK_D23DB048CF11D9C');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E99EC8D52E');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9F59432E1');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB97D2D84D5');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9CF11D9C');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB93DA5256D');
        $this->addSql('ALTER TABLE course_composer DROP FOREIGN KEY FK_31C76B8E591CC992');
        $this->addSql('ALTER TABLE course_composer DROP FOREIGN KEY FK_31C76B8E7A8D2620');
        $this->addSql('ALTER TABLE course_reference DROP FOREIGN KEY FK_2C0209BF591CC992');
        $this->addSql('ALTER TABLE forum DROP FOREIGN KEY FK_852BBECDF675F31B');
        $this->addSql('ALTER TABLE forum_category DROP FOREIGN KEY FK_21BF942629CCBAD0');
        $this->addSql('ALTER TABLE forum_category DROP FOREIGN KEY FK_21BF942612469DE2');
        $this->addSql('ALTER TABLE user_forum_like DROP FOREIGN KEY FK_C8E5268829CCBAD0');
        $this->addSql('ALTER TABLE user_forum_like DROP FOREIGN KEY FK_C8E52688A76ED395');
        $this->addSql('ALTER TABLE user_forum_dislike DROP FOREIGN KEY FK_E1790C8B29CCBAD0');
        $this->addSql('ALTER TABLE user_forum_dislike DROP FOREIGN KEY FK_E1790C8BA76ED395');
        $this->addSql('ALTER TABLE histo_quizz_user DROP FOREIGN KEY FK_57487227A8C00FE5');
        $this->addSql('ALTER TABLE histo_quizz_user DROP FOREIGN KEY FK_57487227A76ED395');
        $this->addSql('ALTER TABLE histo_quizz_quizz DROP FOREIGN KEY FK_D6A700C6A8C00FE5');
        $this->addSql('ALTER TABLE histo_quizz_quizz DROP FOREIGN KEY FK_D6A700C6BA934BCD');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9AC0396');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073A76ED395');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073591CC992');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBA934BCD');
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY FK_7C77973D591CC992');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622591CC992');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE suggest DROP FOREIGN KEY FK_8B867B861E27F6BF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499A1887DC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE user_course DROP FOREIGN KEY FK_73CC7484A76ED395');
        $this->addSql('ALTER TABLE user_course DROP FOREIGN KEY FK_73CC7484591CC992');
        $this->addSql('ALTER TABLE user_instrument DROP FOREIGN KEY FK_9BD8AF31A76ED395');
        $this->addSql('ALTER TABLE user_instrument DROP FOREIGN KEY FK_9BD8AF31CF11D9C');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_course');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE composer');
        $this->addSql('DROP TABLE composer_instrument');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_composer');
        $this->addSql('DROP TABLE course_reference');
        $this->addSql('DROP TABLE forum');
        $this->addSql('DROP TABLE forum_category');
        $this->addSql('DROP TABLE user_forum_like');
        $this->addSql('DROP TABLE user_forum_dislike');
        $this->addSql('DROP TABLE histo_quizz');
        $this->addSql('DROP TABLE histo_quizz_user');
        $this->addSql('DROP TABLE histo_quizz_quizz');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE progression');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE suggest');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_course');
        $this->addSql('DROP TABLE user_instrument');
    }
}
