<?php

// replace with path to your own project bootstrap file

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';


// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();
//$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student[]  $studentList */
//$studentList = $studentRepository->findAll();

/* $studantClass = Student::class;
$sql = "SELECT student, phone, course 
    FROM $studantClass student 
    LEFT JOIN student.phones phone
    LEFT JOIN student.courses course"; */

/** @var Student[]  $studentList */
//$studentList = $entityManager->createQuery($sql)->getResult();


/** @var Student[]  $studentList */
//$studentList = $entityManager->getRepository(Student::class)->findAll();

$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student[]  $studentList */
$studentList = $studentRepository->studentsAndCourse();

foreach ($studentList as $student) {
    
    echo "ID: $student->id\nNome: $student->nome\n";

    if($student->phones()->count() > 0){
        echo PHP_EOL;
        echo "Telefones:";

        echo implode(
            ', ', 
            $student->phones()
                ->map(fn (Phone $phone) => $phone->number)
                ->toArray()
        );

    }
    
    if($student->courses()->count() > 0){
        echo PHP_EOL;
        echo "Cursos:";

        echo implode(
            ', ', 
            $student->courses()
                ->map(fn (Course $course) => $course->nome)
                ->toArray()
        );

    }

    echo PHP_EOL . PHP_EOL;

}

echo count($studentList) . PHP_EOL;
