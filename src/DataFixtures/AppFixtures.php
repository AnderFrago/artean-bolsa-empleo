<?php

namespace App\DataFixtures;

use App\Entity\CvMgr\CVCategories;
use App\Entity\UserMgr\Administrator;
use App\Entity\UserMgr\FormerStudents;
use DateTime;
use Faker;
use App\Entity\OfferMgr\Offers;
use App\Entity\UserMgr\Employeers;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $options = [
            'cost' => 4
        ];
        $pass =  password_hash('4Vientos', PASSWORD_BCRYPT, $options);
        // Administrator
        $admin = new Administrator();
        $admin->setUsername("artean");
        $admin->setEmail("artean@cuatrovientos.org");
        $admin->setPassword($pass);
        $manager->persist($admin);

        // Creating 20 job offers
        for ($i = 0; $i < 2; $i++) {
            $jobFaker = Faker\Factory::create();

            // Employeer
            $employeer = new Employeers();
            $employeer->setUsername("empleador_$i");
            $employeer->setEmail("empleador_$i@cuatrovientos.org");
            $employeer->setPassword($pass);

            $employeer->setVCIF("82102288A");
            $employeer->setVName($jobFaker->company);
            $employeer->setVLogo($jobFaker->imageUrl($width = 640, $height = 480));
            $employeer->setVDescription($jobFaker->sentence);
            $employeer->setVContactName($jobFaker->name);
            $employeer->setVContactPhone($jobFaker->phoneNumber);
            $employeer->setVContactMail($jobFaker->companyEmail);
            $employeer->setVLocation($jobFaker->address);
            $employeer->setNNumberOfWorkers($jobFaker->numberBetween(0, 255));
            $employeer->setCreationUser("InitialFixture");
            $employeer->setCreationDate(new DateTime("2018-6-1"));
            $employeer->setModificationUser("InitialFixture");
            $employeer->setModificationDate(new DateTime("2018-6-1"));

            $manager->persist($employeer);

            // Offer
            $offer = new Offers();
            $offer->setVOfferCode("ACTIVE");
            $offer->setVOfferType('full-time');
            $offer->setDActivationDate(new DateTime("2019-1-1"));
            $offer->setDDueDate(new DateTime("2019-2-$i"));
            $offer->setVPosition("Developer");
            $offer->setLtextDuties($jobFaker->paragraph);
            $offer->setLtextDescription($jobFaker->paragraph);
            $offer->setVSalaray("1200");
            $offer->setLtextExperienceRequirements($jobFaker->paragraph);
            $offer->setVLocation($jobFaker->city . ', ' . $jobFaker->country);

            $offer->setEmployeer($employeer);

            $offer->setCreationUser("InitialFixture");
            $offer->setCreationDate(new DateTime("2018-6-1"));
            $offer->setModificationUser("InitialFixture");
            $offer->setModificationDate(new DateTime("2018-6-1"));

            $manager->persist($offer);
        }

        // Creating 2 FormedStudents
        for ($i = 0; $i < 2; $i++) {
            $studentFaker = Faker\Factory::create();

            $formedStudent = new FormerStudents();
            $formedStudent->setUsername("exalumno_$i");
            $formedStudent->setEmail("exalumno_$i@cuatrovientos.org");
            $formedStudent->setPassword($pass);

            $formedStudent->setVNIF($studentFaker->randomNumber(6));
            $formedStudent->setVName($studentFaker->firstName);
            $formedStudent->setVSurnames($studentFaker->lastName);
            $formedStudent->setVAddress($studentFaker->streetAddress);
            $formedStudent->setDBirthDate($studentFaker->dateTime);
            $formedStudent->setBVehicle($studentFaker->boolean);

            $formedStudent->setCreationUser("InitialFixture");
            $formedStudent->setCreationDate(new DateTime("2018-8-1"));
            $formedStudent->setModificationUser("InitialFixture");
            $formedStudent->setModificationDate(new DateTime("2018-6-1"));
            $manager->persist($formedStudent);
        }

        // Creating Work categories
        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("position");
        $cvCategory->setValue("Scholarship");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("position");
        $cvCategory->setValue("System administrator");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("position");
        $cvCategory->setValue("Developer");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("working time");
        $cvCategory->setValue("full-time");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("working time");
        $cvCategory->setValue("part-time");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("contract type");
        $cvCategory->setValue("undetermined");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Work Experience");
        $cvCategory->setDescription("contract type");
        $cvCategory->setValue("temporary");
        $manager->persist($cvCategory);

        // Creating Study categories
        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study category");
        $cvCategory->setValue("FP");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study level");
        $cvCategory->setValue("Upper vocational training");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study category");
        $cvCategory->setValue("Middle vocational training");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study category");
        $cvCategory->setValue("Basic vocational training");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study family");
        $cvCategory->setValue("System Administrator");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study family");
        $cvCategory->setValue("Developer");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Studies");
        $cvCategory->setDescription("study family");
        $cvCategory->setValue("Logistic");
        $manager->persist($cvCategory);

        // Creating categories for Offer has CVs status
        $cvCategory = new CVCategories();
        $cvCategory->setKey("Offer_has_CVs");
        $cvCategory->setDescription("PENDING");
        $cvCategory->setValue("Status");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Offer_has_CVs");
        $cvCategory->setDescription("ACCEPTED");
        $cvCategory->setValue("Status");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Offer_has_CVs");
        $cvCategory->setDescription("REJECTED");
        $cvCategory->setValue("Status");
        $manager->persist($cvCategory);

        // Offer code categories
        $cvCategory = new CVCategories();
        $cvCategory->setKey("Offers");
        $cvCategory->setDescription("ACTIVE");
        $cvCategory->setValue("Offer_code");
        $manager->persist($cvCategory);

        $cvCategory = new CVCategories();
        $cvCategory->setKey("Offers");
        $cvCategory->setDescription("INACTIVE");
        $cvCategory->setValue("Offer_coce");
        $manager->persist($cvCategory);




        $manager->flush();
    }
}
