<?php

namespace App\Http\Controllers;

use App\Factories\FormatFactory;
use App\Factories\PlayerFilterFactory;
use Exception;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    /**
     * @var FormatFactory
     */
    private FormatFactory $formatFactory;

    /**
     * @var PlayerFilterFactory
     */
    private PlayerFilterFactory $playerFilterFactory;

    /**
     * @param FormatFactory $formatFactory
     * @param PlayerFilterFactory $playerFilterFactory
     */
    public function __construct(
        FormatFactory $formatFactory,
        PlayerFilterFactory $playerFilterFactory
    ) {
        $this->formatFactory = $formatFactory;
        $this->playerFilterFactory = $playerFilterFactory;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $data = $this->playerFilterFactory->make($request->get('type'))->fetch($request->all());
            
            return $this->formatFactory->make($request->get('format'))->format($data->toArray());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
