<?php

// replace with path to your own project bootstrap file

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';


// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();

$course = new Course($argv['1']);

$entityManager->persist($course);
$entityManager->flush();
