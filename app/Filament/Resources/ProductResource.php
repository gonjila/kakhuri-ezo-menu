<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required(),
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('uploads/products')
                    ->visibility('public')
                    ->deletable()
                    ->preserveFilenames()
                    ->previewable()
                    ->openable()
                    ->maxSize(20 * 1024)
                    ->acceptedFileTypes(['image/png', 'image/jpeg'])
                    ->helperText('Each image should be less than 20MB and in .jpg, .png formats.')
                    ->reorderable(),

                Group::make([
                    Group::make([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('ლ'),
                        TextInput::make('discount')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->prefix('%')
                            ->afterStateUpdated(function (callable $set, $state, Get $get) {
                                if ($state !== null && $get('price')) {
                                    $set('discounted_price', round($get('price') - ($get('price') * ($state / 100)), 1));
                                }
                            })
                            ->placeholder('Enter discount percentage')
                            ->reactive(),
                        TextInput::make('discounted_price')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(fn (Get $get) => $get('price'))
                            ->prefix('ლ')
                            ->afterStateUpdated(function (callable $set, $state, Get $get) {
                                if ($state !== null && $get('price')) {
                                    $set('discount', round((($get('price') - $state) / $get('price')) * 100));
                                }
                            })
                            ->placeholder('Enter discounted price')
                            ->reactive(),
                    ])
                        ->columns(3),

                    Group::make([
                        Toggle::make('is_popular')
                            ->required(),
                        Toggle::make('is_in_stock')
                            ->required(),
                    ])->columns(3),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('images')
//                    ->label('სურათები')
                    ->disk('public') // Ensure this matches your filesystem configuration
                    ->height(100)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')
                    ->money()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('discount')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('discounted_price')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_popular')
                    ->boolean(),
                IconColumn::make('is_in_stock')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
