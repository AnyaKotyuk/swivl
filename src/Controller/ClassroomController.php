<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\SourceNotFoundException;
use App\Repository\ClassroomRepository;
use App\Rest\Builder\ClassroomBuilder;
use App\Rest\Entity\RestClassroom;
use App\Rest\Service\ClassroomValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ClassroomController
 * @package App\Controller
 *
 * @Route("/classrooms")
 */
class ClassroomController extends AbstractController
{
    /**
     * @Route("/", name="classroom_list", methods={"GET"})
     */
    public function getList(
        ClassroomRepository $classroomRepository,
        SerializerInterface $serializer,
        ClassroomBuilder $classroomBuilder
    ): Response {
        $restClassRoomList = [];
        foreach ($classroomRepository->findAll() as $classroom) {
            $restClassRoomList[] = $classroomBuilder->createRestClassroom($classroom);
        }

        return new JsonResponse($serializer->serialize($restClassRoomList, 'json'), Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}", name="classroom_item", methods={"GET"})
     */
    public function getItem(
        int $id,
        ClassroomRepository $classroomRepository,
        SerializerInterface $serializer,
        ClassroomBuilder $classroomBuilder
    ) : Response {
        $classroom = $classroomRepository->findOneById($id);

        if (!$classroom) {
            throw new NotFoundHttpException();
        }
        $restClassRoom = $classroomBuilder->createRestClassroom($classroom);

        return new Response([$serializer->serialize($restClassRoom, 'json')]);
    }

    /**
     * @Route("/", name="classroom_create", methods={"POST"})
     */
    public function createItem(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ClassroomBuilder $classroomBuilder,
        ClassroomValidator $classroomValidator
    ) : Response {
        /** @var RestClassroom $restClassroom */
        $restClassroom = $serializer->deserialize($request->getContent(), RestClassroom::class, 'json');

        $classroomValidator->validate($restClassroom);
        $classroom = $classroomBuilder->createClassroom($restClassroom);

        $entityManager->persist($classroom);
        $entityManager->flush();

        return new Response(null, Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", name="classroom_update", methods={"PUT"})
     */
    public function updateItem(
        int $id,
        Request $request,
        ClassroomRepository $classroomRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ClassroomBuilder $classroomBuilder,
        ClassroomValidator $classroomValidator
    ) : Response {
        $classroom = $classroomRepository->findOneById($id);

        if (!$classroom) {
            throw new SourceNotFoundException('Classroom');
        }

        /** @var RestClassroom $restClassroom */
        $restClassroom = $serializer->deserialize($request->getContent(), RestClassroom::class, 'json');
        $classroomValidator->validate($restClassroom);

        $classroomBuilder->updateClassroom($restClassroom, $classroom);

        $entityManager->persist($classroom);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}", name="classroom_delete", methods={"DELETE"})
     */
    public function deleteItem(
        int $id,
        ClassroomRepository $classroomRepository,
        EntityManagerInterface $entityManager
    ) : Response {
        $classroom = $classroomRepository->findOneById($id);

        if (!$classroom) {
            throw new SourceNotFoundException('Classroom');
        }

        $entityManager->remove($classroom);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}/activate", name="classroom_activate", methods={"PUT"})
     */
    public function activateItem(
        int $id,
        ClassroomRepository $classroomRepository,
        EntityManagerInterface $entityManager
    ) : Response {
        $classroom = $classroomRepository->findOneById($id);

        if (!$classroom) {
            throw new SourceNotFoundException('Classroom');
        }

        $classroom->setActive(1);
        $entityManager->persist($classroom);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}/deactivate", name="classroom_deactivate", methods={"PUT"})
     */
    public function deactivateItem(
        int $id,
        ClassroomRepository $classroomRepository,
        EntityManagerInterface $entityManager
    ) : Response {
        $classroom = $classroomRepository->findOneById($id);

        if (!$classroom) {
            throw new SourceNotFoundException('Classroom');
        }

        $classroom->setActive(0);
        $entityManager->persist($classroom);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
