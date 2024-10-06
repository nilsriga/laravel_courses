<div>
    <h1>Welcome to Course Tracker</h1>

    <h2>Users</h2>
    <ul>
        @foreach ($users as $user)
        <li>{{ $user->name }}</li>
        @endforeach
    </ul>

    <h2>Users</h2>
    <x-filament-tables::table>
        <x-slot name="header">
            <x-filament-tables::header-cell>Name</x-filament-tables::header-cell>
        </x-slot>

        <x-slot name="body">
            @foreach ($users as $user)
                <x-filament-tables::row>
                    <x-filament-tables::cell>{{ $user->name }}</x-filament-tables::cell>
                </x-filament-tables::row>
            @endforeach
        </x-slot>
    </x-filament-tables::table>



    <h2>Courses</h2>
    <ul>
        @foreach ($courses as $course)
            <li>{{ $course->title }}</li>
        @endforeach
    </ul>

    <h2>Add Course</h2>
    <form wire:submit.prevent="saveCourse">
        {{ $this->form }}
        <button type="submit">Add</button>
    </form>

    <h2>User Courses</h2>
    <ul>
        @foreach ($userCourses as $userCourse)
            <li>
                {{ $userCourse->user->name }} - {{ $userCourse->course->title }} - {{ $userCourse->status }}
                @if ($userCourse->certificate)
                    <a href="{{ asset('storage/' . $userCourse->certificate) }}" target="_blank">View Certificate</a>
                @endif
            </li>
        @endforeach
    </ul>

    <h2>Add User Course</h2>
    <form wire:submit.prevent="saveUserCourse">
        {{ $this->form }}
        <button type="submit">Add</button>
    </form>
</div>
