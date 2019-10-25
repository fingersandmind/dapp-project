<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Saumini\Count\RelationshipCount;

class Dapps extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group = 'Dapp Tools';

    public static $model = 'App\Dapp';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'dapp_name';

    public function subtitle()
    {
        return $this->website;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','dapp_name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            TextWithSlug::make('Dapp Name')
                ->slug('slug')->rules(['required','max:244'])->sortable(),

            Slug::make('Slug')->creationRules(['unique:dapps'])->updateRules('required')->nullable()->hideFromIndex(),

            BelongsTo::make('Category','category','App\Nova\Categories')->searchable(),

            Text::make('Email')->rules(['required','email']),
            Text::make('Website')->hideFromIndex(),
            Url::make('Website')
            ->label('Website')->onlyOnIndex()->clickableOnIndex(),
            Textarea::make('Description')->hideFromIndex(),
            Text::make('Video Url')->hideFromIndex(),

            RelationshipCount::make('Smart Contracts', 'contracts')->withMeta(['extraAttributes' => ['class' => 'text-center']]),

            Avatar::make('Dapp Logo')->rules(['dimensions:min_width=250,max_width=250,min_height=250,max_height=250','max:200'])->disableDownload()->hideFromIndex(),
            Image::make('Dapp Icon')->rules(['dimensions:min_width=125,max_width=125,min_height=125,max_height=125','max:150'])->disableDownload()->hideFromIndex(),

            Select::make('Status')->options([
                'Pending' => 'Pending',
                'Enabled' => 'Enabled',
                'Disabled' => 'Disabled',
            ])->displayUsingLabels()->sortable(),

            Text::make('Twitter')->rules(['max:100'])->hideFromIndex(),
            Text::make('Facebook')->rules(['max:100'])->hideFromIndex(),
            Text::make('Telegram')->rules(['max:100'])->hideFromIndex(),
            Text::make('Discord')->rules(['max:100'])->hideFromIndex(),
            Text::make('Reddit')->rules(['max:100'])->hideFromIndex(),
            Text::make('Bitcointalk')->rules(['max:100'])->hideFromIndex(),
            Text::make('Wechat')->rules(['max:100'])->hideFromIndex(),

            Textarea::make('Notes')->hideFromIndex(),

            HasMany::make('Contracts','contracts','App\Nova\Contracts'),
            HasMany::make('Images','uploads','App\Nova\Uploads'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
