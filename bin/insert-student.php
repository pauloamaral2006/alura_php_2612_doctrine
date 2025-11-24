<?php

// replace with path to your own project bootstrap file

use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';


// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();

$student = new Student($argv['1']);

for($i = 2; $i < count($argv); $i++){

    $student->addPhone(new Phone($argv[$i]));

}

$entityManager->persist($student);
$entityManager->flush();
