<?php

namespace App\Orchid\Layouts\Log;

use App\Models\Log;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class LogListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'logs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('method', __('Method'))
                ->sort()
                ->cantHide()
                ->render(function (Log $log) {
                    return $log->method;
                }),

            TD::make('http_code', __('Code'))
                ->sort()
                ->cantHide()
                ->render(function (Log $log) {
                    return $log->http_code;
                }),

            TD::make('url', __('Url'))
                ->sort()
                ->cantHide()
                ->render(function (Log $log) {
                    return $log->url;
                }),
            
            TD::make('created_at', __('Created'))
                ->sort()
                ->cantHide()
                ->render(function (Log $log) {
                    return $log->created_at;
                }),

            TD::make(__('Download response'))
                ->align(TD::ALIGN_CENTER)
                ->width('200px')
                ->render(function (Log $log) {
                    return Link::make()
                        ->route('platform.content.logs.download', $log->id)
                        ->icon('cloud-download');
                }),

        ];
    }
}
