<?php

namespace App\Orchid\Screens\Article;

use Orchid\Screen\Screen;
use \App\Orchid\Layouts\Article\ArticleListLayout;
use \App\Models\Article;

class ArticleListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Articles';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All articles';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'articles' => Article::paginate(10),
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
            ArticleListLayout::class,
        ];
    }
}
