<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Contracts\Repositories\TeamRepositoryInterface;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    /**
     * @var PlayerRepositoryInterface
     */
    private PlayerRepositoryInterface $playerRepository;

    /**
     * @var TeamRepositoryInterface
     */
    private TeamRepositoryInterface $teamRepository;

    /**
     * @param PlayerRepositoryInterface $playerRepository
     * @param TeamRepositoryInterface $teamRepository
     */
    public function __construct(
        PlayerRepositoryInterface $playerRepository,
        TeamRepositoryInterface $teamRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $teams = $this->teamRepository->getAll();
        $threePtShooters = $this->playerRepository->getBy3ptShooting();
        $threePtTeams = $this->teamRepository->getBy3ptShooting();
        
        return view('report', [
            'teams' => $teams->toArray(),
            'threePtShooters' => $threePtShooters->toArray(),
            'threePtTeams' => $threePtTeams->toArray()
        ]);
    }
}
