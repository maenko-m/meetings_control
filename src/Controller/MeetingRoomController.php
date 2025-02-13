<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\MeetingRoom;
use App\Repository\MeetingRoomRepository;
use App\Service\MeetingRoomAccessChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/meeting-room')]
final class MeetingRoomController extends AbstractController
{
    #[Route(name: 'app_meeting_room_get_all', methods: ['GET'])]
    public function index(MeetingRoomRepository $meetingRoomRepository, MeetingRoomAccessChecker $accessChecker): JsonResponse
    {
        $employee = $this->getUser();

        if (!$employee instanceof Employee) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $rooms = $meetingRoomRepository->findAll();
        $availableRooms = array_filter($rooms, fn(MeetingRoom $room) => $accessChecker->canAccess($room, $employee));

        return $this->json($availableRooms);
    }
}
