<?php

// replace with path to your own project bootstrap file

use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';


// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();
$studentRepository = $entityManager->getRepository(Student::class);

$student = $studentRepository->find($argv[1]);
//$student = $entityManager->getReference(Student::class, $argv[1]);

$entityManager->remove($student);
$entityManager->flush();
