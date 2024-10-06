<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use App\Models\User;
use App\Models\Course;
use App\Models\UserCourse;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseTracker extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-divide';

    protected static string $view = 'filament.pages.course-tracker';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('slug'),
                IconColumn::make('is_featured')
                    ->boolean(),
            ]);
    }

    public function saveCourse()
    {
        $data = $this->form->getState();
        Course::create($data);
        $this->resetForm();
    }

    public function saveUserCourse()
    {
        $data = $this->form->getState();
        UserCourse::create($data);
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->form->fill([]);
    }
    public function mount()
    {
        $this->users = User::all();
        $this->courses = Course::all();
        $this->userCourses = UserCourse::with('user', 'course')->get();
    }

    protected function getViewData(): array
    {
        return [
            'users' => $this->users,
            'courses' => $this->courses,
            'userCourses' => $this->userCourses,
        ];
    }
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required(),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required(),
            Forms\Components\Select::make('user_id')
                ->label('User')
                ->options(User::all()->pluck('name', 'id'))
                ->required(),
            Forms\Components\Select::make('course_id')
                ->label('Course')
                ->options(Course::all()->pluck('title', 'id'))
                ->required(),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'completed' => 'Completed',
                    'discontinued' => 'Discontinued',
                ])
                ->required(),
            Forms\Components\FileUpload::make('certificate')
                ->label('Certificate'),
        ];
    }
}
