<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserCourseResource\Pages;
use App\Filament\Resources\UserCourseResource\RelationManagers;
use App\Models\UserCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserCourseResource extends Resource
{
    protected static ?string $model = UserCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'completed' => 'Completed',
                        'discontinued' => 'Discontinued',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('completed_at')
                    ->label('Completion Date')
                    ->nullable(),
                Forms\Components\FileUpload::make('certificate')
                    ->label('Certificate')
                    ->directory('certificates')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('course.title')->label('Course')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('completed_at')->dateTime()->label('Completion Date'),
                Tables\Columns\TextColumn::make('certificate')->label('Certificate')->url(fn ($record) => $record->certificate ? asset('storage/' . $record->certificate) : null),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUserCourses::route('/'),
            'create' => Pages\CreateUserCourse::route('/create'),
            'edit' => Pages\EditUserCourse::route('/{record}/edit'),
        ];
    }
}
