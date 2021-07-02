<?php

namespace App\Orchid\Screens\Log;

use Orchid\Screen\Screen;
use \App\Orchid\Layouts\Log\LogListLayout;
use \App\Models\Log;

class LogListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Logs';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All logs';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'logs' => Log::paginate(10),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            LogListLayout::class
        ];
    }
}
