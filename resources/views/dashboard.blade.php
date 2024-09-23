<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    @section('content')

    <h1 class="text-3xl font-bold mb-6">Welcome to Course Tracker</h1>

    <h2 class="text-2xl font-semibold mt-8 mb-4">Users</h2>
    <ul class="list-disc list-inside pl-4">
        @foreach($users as $user)
            <li class="text-lg">{{ $user->name }}</li>
        @endforeach
    </ul>

    <h2 class="text-2xl font-semibold mt-8 mb-4">Courses</h2>
    <ul class="list-disc list-inside pl-4">
        @foreach ($courses as $course)
            <li class="text-lg">{{ $course->title }}</li>
        @endforeach
    </ul>

    <h2 class="text-2xl font-semibold mt-8 mb-4 ">Add Course</h2>
    <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        </div>
        <div>
            <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
            <textarea name="description" id="description"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"></textarea>
        </div>
        <button type="submit"
            class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg">Add</button>
    </form>

    <h2 class="text-2xl font-semibold mt-8 mb-4">User Courses</h2>
    <ul class="list-disc list-inside pl-4">
        @foreach ($userCourses as $userCourse)
            <li class="text-lg">
                {{ $userCourse->user->name }} - {{ $userCourse->course->title }} - {{ $userCourse->status }}
                @if ($userCourse->certificate)
                    <a href="{{ asset('storage/' . $userCourse->certificate) }}" target="_blank"
                        class="text-blue-500 underline ml-2">View Certificate</a>
                @endif
            </li>
        @endforeach
    </ul>

    <h2 class="text-2xl font-semibold mt-8 mb-4">Add User Course</h2>
    <form action="{{ route('user_courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="user_id" class="block text-lg font-medium text-gray-700">User</label>
            <select name="user_id" id="user_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="course_id" class="block text-lg font-medium text-gray-700">Course</label>
            <select name="course_id" id="course_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block text-lg font-medium text-gray-700">Status</label>
            <select name="status" id="status"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="completed">Completed</option>
                <option value="discontinued">Discontinued</option>
            </select>
        </div>
        <div>
            <label for="certificate" class="block text-lg font-medium text-gray-700">Certificate</label>
            <input type="file" name="certificate" id="certificate"
                class="mt-1 block w-full text-base text-gray-900 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <button type="submit"
            class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg">Add</button>
    
    </form>


    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>