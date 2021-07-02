<?php

namespace App\Orchid\Screens\Article;

use Orchid\Screen\Screen;
use \App\Orchid\Layouts\Article\ArticleEditLayout;
use \App\Models\Article;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class ArticleEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Atricle';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Atricle Edit';

    /**
     * @var Article
     */
    private $article;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Article $article): array
    {
        $this->description = $article->title;
        $this->article = $article;
        return [
            'article' => $article,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
            ->icon('trash')
            ->confirm(__('You sure?'))
            ->method('onRemove'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            ArticleEditLayout::class,
        ];
    }

    public function onRemove(Article $article)
    {
        $article->delete();

        Toast::info(__('Article was removed'));

        return redirect()->route('platform.content.articles');
    }
}
