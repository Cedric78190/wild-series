<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program/', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('', methods: ['GET'], name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {

        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
         ]);
    }

    #[Route('show/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
    public function show(int $id, Program $program, SeasonRepository $seasonRepository): Response
    {   
        $seasons = $seasonRepository->findByProgram($program);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '. $id .' found.'
            );
        }

        if (!$seasons) {
            throw $this->createNotFoundException(
                'No season with id : '. $id .' found.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program, 'seasons' => $seasons
        ]);
    }

    #[Route('{programId}/seasons/{seasonId}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository, ProgramRepository $programRepository)
    {
        $program = $programRepository->findOneById($programId);
        $season = $seasonRepository->findOneById($seasonId);
        $episodes = $episodeRepository->findBySeason($season);

        return $this->render('program/season_show.html.twig', [
            'program' => $program, 'season' => $season, 'episodes' => $episodes
        ]);
    }
}