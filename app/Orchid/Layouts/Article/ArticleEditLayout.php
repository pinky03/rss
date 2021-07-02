<?php

namespace App\Orchid\Layouts\Article;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;

class ArticleEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('article.title')
                ->title('Title')
                ->placeholder('Enter title here'),

            Input::make('article.link')
                ->title('Link')
                ->placeholder('Enter source link here'),

            Input::make('article.author')
                ->title('Author')
                ->placeholder('Enter author here'),

            TextArea::make('article.description')
                ->rows(5)
                ->title('Desctiption'),
            
        ];
    }
}
