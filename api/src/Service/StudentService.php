<?php

namespace App\Service;

use App\Entity\Student;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOneStudent(int $id): JsonResponse
    {
        $student = $this->entityManager->getRepository(Student::class)->find($id);

        if (!$student) {
            return new JsonResponse(['error' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $studentData = [
            'id' => $student->getId(),
            'firstName' => $student->getFirstName(),
            'lastName' => $student->getLastName(),
            'email' => $student->getEmail(),
            'photo' => $student->getPhoto(),
            'individual' => $student->isInvidual(),
            'createdAt' => $student->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $student->getUpdatedAt() ? $student->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ];

        return new JsonResponse($studentData, Response::HTTP_OK);
    }

    public function getAllStudents(): JsonResponse
    {
        $students = $this->entityManager->getRepository(Student::class)->findAll();

        $studentsData = [];

        foreach ($students as $student) {
            $studentData = [
                'id' => $student->getId(),
                'firstName' => $student->getFirstName(),
                'lastName' => $student->getLastName(),
                'email' => $student->getEmail(),
                'photo' => $student->getPhoto(),
                'individual' => $student->isInvidual(),
                'createdAt' => $student->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $student->getUpdatedAt() ? $student->getUpdatedAt()->format('Y-m-d H:i:s') : null,
                'deletedAt' => $student->getDeletedAt() ? $student->getDeletedAt()->format('Y-m-d H:i:s') : null,
            ];

            $studentsData[] = $studentData;
        }

        return new JsonResponse($studentsData, Response::HTTP_OK);
    }

    public function newStudent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $student = new Student();

        if (!isset($data['firstName']) || !isset($data['lastName']) || !isset($data['email']) || !isset($data['photo']) || !isset($data['invidual'])) {
            return new JsonResponse(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^\S+@\S+\.\S+$/", $data['email'])) {
            return new JsonResponse(['error' => 'Invalid email format'], Response::HTTP_BAD_REQUEST);
        }

        if ($this->entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']])) {
            return new JsonResponse(['error' => 'Email already exists'], Response::HTTP_CONFLICT);
        }

        $student->setFirstName($data['firstName']);
        $student->setLastName($data['lastName']);
        $student->setEmail($data['email']);
        $student->setPhoto($data['photo'] ?? null);
        $student->setCreatedAt();
        $student->setInvidual($data['invidual']);
        $student->setPassword($data['password']);

        try {
            $this->entityManager->persist($student);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to save the student'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Student created successfully'], Response::HTTP_CREATED);
    }

    public function editStudent(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $student = $this->entityManager->getRepository(Student::class)->find($id);

        if (!$student) {
            return new JsonResponse(['error' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        if (isset($data['firstName'])) {
            $student->setFirstName($data['firstName']);
        }
        if (isset($data['lastName'])) {
            $student->setLastName($data['lastName']);
        }
        if (isset($data['email'])) {
            if (!preg_match("/^\S+@\S+\.\S+$/", $data['email'])) {
                return new JsonResponse(['error' => 'Invalid email format'], Response::HTTP_BAD_REQUEST);
            }
            if ($data['email'] != $student->getEmail() && $this->entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']])) {
                return new JsonResponse(['error' => 'Email already exists'], Response::HTTP_CONFLICT);
            }
            $student->setEmail($data['email']);
        }
        if (isset($data['photo'])) {
            $student->setPhoto($data['photo']);
        }
        if (isset($data['individual'])) {
            $student->setIndividual($data['individual']);
        }
        if (isset($data['password'])) {
            $student->setPassword($data['password']);
        }
        
        $student->setUpdatedAt();

        try {
            $this->entityManager->persist($student);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to edit the student'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Student edited successfully'], Response::HTTP_OK);
    }

    public function deleteStudent(int $id): JsonResponse
    {
        $student = $this->entityManager->getRepository(Student::class)->find($id);

        if (!$student) {
            return new JsonResponse(['error' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        try {
            // $this->entityManager->remove($student);
            $student->setDeletedAt();
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to delete the student'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Student deleted successfully'], Response::HTTP_OK);
    }

}
