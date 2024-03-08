<?php

namespace App\Service;

use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOneResource(int $id): JsonResponse
    {
        $resource = $this->entityManager->getRepository(Resource::class)->find($id);
        
        if (!$resource) {
            return new JsonResponse(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
        }

        $resourceData = [
            'id' => $resource->getId(),
            'name' => $resource->getName(),
            'description' => $resource->getDescription(),
            'createdAt' => $resource->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $resource->getUpdatedAt() ? $resource->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            'deletedAt' => $resource->getUpdatedAt() ? $resource->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ];

        return new JsonResponse($resourceData, Response::HTTP_OK);
    }

    public function getAllResources(): JsonResponse
    {
        $resources = $this->entityManager->getRepository(Resource::class)->createQueryBuilder('r')
            ->where('r.deletedAt IS NULL')
            ->getQuery()
            ->getResult();

        if (!$resources) {
            return new JsonResponse(['error' => 'No resources found'], Response::HTTP_NOT_FOUND);
        }

        $toReturn = [];

        foreach ($resources as $resource) {
            $toReturn[] = [
                'id' => $resource->getId(),
                'name' => $resource->getName(),
                'description' => $resource->getDescription(),
                'createdAt' => $resource->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $resource->getUpdatedAt() ? $resource->getUpdatedAt()->format('Y-m-d H:i:s') : null,
                'deletedAt' => $resource->getUpdatedAt() ? $resource->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }


        return new JsonResponse($toReturn, Response::HTTP_OK);
    }

    public function getRessourcesByLesson(int $id) : JsonResponse
    {
        $resources = $this->entityManager->getRepository(Resource::class)->createQueryBuilder('r')
            ->where('r.deletedAt IS NULL')
            ->andWhere('r.lesson = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        if (!$resources) {
            return new JsonResponse(['error' => 'No resources found'], Response::HTTP_NOT_FOUND);
        }

        $toReturn = [];

        foreach ($resources as $resource) {
            $toReturn[] = [
                'id' => $resource->getId(),
                'name' => $resource->getName(),
                'description' => $resource->getDescription(),
                'createdAt' => $resource->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $resource->getUpdatedAt() ? $resource->getUpdatedAt()->format('Y-m-d H:i:s') : null,
                'deletedAt' => $resource->getUpdatedAt() ? $resource->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }

        return new JsonResponse($toReturn, Response::HTTP_OK);
    }

    public function newResource(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $resource = new Resource();

        if (!isset($data['name']) || !isset($data['description'])) {
            return new JsonResponse(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        $resource->setName($data['name']);
        $resource->setDescription($data['description']);
        $todayDate = new \DateTimeImmutable();
        $resource->setCreatedAt($todayDate);

        try {
            $this->entityManager->persist($resource);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to save the resource'.$e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Resource created successfully'], Response::HTTP_CREATED);
    }

    public function editResource(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $resource = $this->entityManager->getRepository(Resource::class)->find($id);

        if (!$resource) {
            return new JsonResponse(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
        }

        if (isset($data['firstName'])) {
            $resource->setFirstName($data['firstName']);
        }
        if (isset($data['lastName'])) {
            $resource->setLastName($data['lastName']);
        }
        if (isset($data['email'])) {
            if (!preg_match("/^\S+@\S+\.\S+$/", $data['email'])) {
                return new JsonResponse(['error' => 'Invalid email format'], Response::HTTP_BAD_REQUEST);
            }
            if ($data['email'] != $resource->getEmail() && $this->entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']])) {
                return new JsonResponse(['error' => 'Email already exists'], Response::HTTP_CONFLICT);
            }
            $resource->setEmail($data['email']);
        }
        if (isset($data['photo'])) {
            $resource->setPhoto($data['photo']);
        }
        if (isset($data['invidual'])) {
            $resource->setInvidual($data['invidual']);
        }
        if (isset($data['password'])) {
            $resource->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $resource,
                    $data['password']
                )
            );
        }

        $resource->setUpdatedAt();

        try {
            $this->entityManager->persist($resource);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to edit the resource'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Resource edited successfully'], Response::HTTP_OK);
    }

    public function deleteResource(int $id): JsonResponse
    {
        $resource = $this->entityManager->getRepository(Resource::class)->find($id);

        if (!$resource) {
            return new JsonResponse(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
        }

        try {
            // $this->entityManager->remove($resource);
            $resource->setDeletedAt();
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to delete the resource'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
    }
}
