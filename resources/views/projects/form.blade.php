<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('translation.navigation.projects')}}
        </h2>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    @if (isset($project))
                        <livewire:projects.project-form :project="$project" :editMode="true" />
                    @else
                        <livewire:projects.project-form :editMode="false" />
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
