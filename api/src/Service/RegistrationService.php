<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Training;
use App\Entity\Student;
use App\Entity\Registration;

class RegistrationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $training = $this->entityManager->getRepository(Training::class)->findOneById($data["training_id"]);

        if ($training == null) {
            throw new NotFoundHttpException('Error while creating registration: Training not found');
        }

        $student = $this->entityManager->getRepository(Student::class)->findOneById($data["student_id"]);

        if ($student == null) {
            throw new NotFoundHttpException('Error while creating registration: Student not found');
        }

        $registration = new Registration();
        $registration->setCreatedAt();
        $registration->setTraining($training);
        $registration->setStudent($student);

        try {
            $this->entityManager->persist($registration);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to create the registration'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Registration created successfully'], Response::HTTP_CREATED);
    }

    public function read(int $id): Response
    {
        $registration = $this->entityManager->getRepository(Registration::class)->findOneById($id);

        if ($registration == null) {
            throw new NotFoundHttpException('Error while reading registration: Registration not found');
        }
        $data = [
            'id' => $registration->getId(),
            'training_id' => $registration->getTraining()->getId(),
            'student_id' => $registration->getStudent()->getId(),
            'created_at' => $registration->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $registration->getUpdatedAt() ? $registration->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            'deleted_at' => $registration->getDeletedAt() ? $registration->getDeletedAt()->format('Y-m-d H:i:s') : null
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function readAll(): Response
    {
        $registrations = $this->entityManager->getRepository(Registration::class)->findAll();
        $data = [];

        foreach ($registrations as $registration) {
            $data[] = [
                'id' => $registration->getId(),
                'training_id' => $registration->getTraining()->getId(),
                'student_id' => $registration->getStudent()->getId(),
                'created_at' => $registration->getCreatedAt()->format('Y-m-d H:i:s'),
                'updated_at' => $registration->getUpdatedAt() ? $registration->getUpdatedAt()->format('Y-m-d H:i:s') : null,
                'deleted_at' => $registration->getDeletedAt() ? $registration->getDeletedAt()->format('Y-m-d H:i:s') : null
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function update(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $registration = $this->entityManager->getRepository(Registration::class)->findOneById($id);

        if ($registration == null) {
            throw new NotFoundHttpException('Error while updating registration: Registration not found');
        }

        $training = $this->entityManager->getRepository(Training::class)->findOneById($data["training_id"]);

        if ($training == null) {
            throw new NotFoundHttpException('Error while updating registration: Training not found');
        }

        $student = $this->entityManager->getRepository(Student::class)->findOneById($data["student_id"]);

        if ($student == null) {
            throw new NotFoundHttpException('Error while updating registration: Student not found');
        }

        $registration->setTraining($training);
        $registration->setStudent($student);
        $registration->setUpdatedAt();

        try {
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to update the registration'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Registration updated successfully'], Response::HTTP_OK);
    }

    public function delete(int $id): Response
    {
        $registration = $this->entityManager->getRepository(Registration::class)->findOneById($id);

        if ($registration == null) {
            throw new NotFoundHttpException('Error while deleting registration: Registration not found');
        }

        try {
            $this->entityManager->remove($registration);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to delete the registration'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Registration deleted successfully'], Response::HTTP_OK);
    }
}