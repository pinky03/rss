<?php

namespace App\Orchid\Layouts\Article;

use App\Models\Article;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class ArticleListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'articles';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', __('Title'))
                ->sort()
                ->cantHide()
                ->render(function (Article $article) {
                    return $article->title;
                }),

            TD::make('publication', __('Publication'))
                ->sort()
                ->cantHide()
                ->render(function (Article $article) {
                    return $article->pub_date;
                }),

            TD::make(__('Edit'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Article $article) {
                    return Link::make()
                        ->route('platform.content.articles.edit', $article->id)
                        ->icon('pencil');
                }),
        ];
    }
}
