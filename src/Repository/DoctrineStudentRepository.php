<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Student;
use Doctrine\ORM\EntityRepository;

class DoctrineStudentRepository extends EntityRepository
{

    /**
     * @return Student[]
     */
    public function studentsAndCourse() : array {

        
        return $this->createQueryBuilder('student')
            ->addSelect('phone')
            ->addSelect('course')
            ->leftJoin('student.phones','phone')
            ->leftJoin('student.courses','course')
            ->getQuery()
            ->getResult();

        /* $studantClass = Student::class;
        $sql = "SELECT student, phone, course 
            FROM $studantClass student 
            LEFT JOIN student.phones phone
            LEFT JOIN student.courses course"; */

        /** @var Student[]  $studentList */
        //return $this->getEntityManager()->createQuery($sql)->getResult();

    }

}