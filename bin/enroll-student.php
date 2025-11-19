<?php

// replace with path to your own project bootstrap file

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';


// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();

$studentId = $argv[1];
$coursetId = $argv[2];

$student = $entityManager->find(Student::class, $studentId);
$course = $entityManager->find(Course::class, $coursetId);

$student->enrollInCourse($course);

$entityManager->flush();
