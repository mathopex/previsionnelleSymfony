<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    #[Route('/calendrier', name: 'app_calendrier')]
    public function getCalendrierByMonth(CalendrierRepository $calendrierRepository, Request $request): Response
    {
        $month = $request->query->getInt('month');
        $year = $request->query->getInt('year');

        if (!$month || !$year) {
            return $this->json(['error' => "Le mois et l'année sont requis pour le filtrage"], 400);
        }

        $startDate = new \DateTimeImmutable(sprintf('%s-%s-01', $year, $month));
        $endDate = $startDate->modify('last day of this month');

        $calendriers = $calendrierRepository->findByDateRange($startDate, $endDate);

        return $this->json($calendriers);
    }
}
