<?php

use App\Models\{AppType, Language, Project, Tech};
use function Livewire\Volt\{computed, layout, mount, on, state, title};

layout('layouts.app');
title('Showcase WPU');

$projects = computed(function(){
    return Project::with(['teches', 'languages', 'appType', 'time'])->get();
})->persist();

$app_types = computed(function(){
    return AppType::all();
})->persist();
$languages = computed(function(){
    return Language::all();
})->persist();
$teches = computed(function(){
    return Tech::all();
})->persist();

state(['filterByType', 'filterByTeches', 'filterByLanguages',  'filterBySearch','filterByTime', 'dev']);

mount(function(){
    $this->dev = 0;
    $this->filterBySearch = '';
    $this->filterByType = 0;
    $this->filterByLanguages = [];
    $this->filterByTeches = [];
});

on(['update-filtered-projects' => function () {
    $this->projects = $this->projects
    ->when(!empty($this->filterByType), function($filteredProjects){
        return $filteredProjects->where('app_type_id', $this->filterByType);
    })
    ->when(!empty($this->filterByTeches), function($filteredProjects){
        return $filteredProjects->filter(function($filteredProjects){
            // $filteredProjects->teches->contains
            foreach ($filteredProjects->teches as $tech) {
                foreach ($this->filterByTeches as $filter) {
                    if($tech->id == $filter){
                        return $tech->id == $filter;
                    };
                }
            }
        });
    })
    ->when(!empty($this->filterByLanguages), function($filteredProjects){
        return $filteredProjects->filter(function($filteredProjects){
            foreach ($filteredProjects->languages as $language) {
                foreach ($this->filterByLanguages as $filter) {
                    if($language->id == $filter){
                        return $language->id == $filter;
                    };
                }
            }
        });
    })
    ->when(!empty($this->filterBySearch), function($filteredProjects){
        return $filteredProjects->filter(function($filteredProjects){
            if(str_contains($filteredProjects->name, $this->filterBySearch)){
                return true;
            } else {
                return false;
            }
        });
    })
    ;
}]);

$clearFilter = function() {
    $this->filterByType = 0;
    $this->filterByLanguages = [];
    $this->filterByTeches = [];
    $this->filterBySearch = '';
};
$setAppType = function($value) {
    if ($this->filterByType == $value) {
        $this->filterByType = '';
    }else {
        $this->filterByType = $value;
    }
    $this->dispatch('update-filtered-projects');
};
$setLanguages = function($value) {
    if(in_array($value, $this->filterByLanguages)){
        $index = array_search($value, $this->filterByLanguages);
        array_splice($this->filterByLanguages, $index, 1);
    } else{
        array_push($this->filterByLanguages, $value);
    };
    $this->dispatch('update-filtered-projects');
};
$setTeches = function($value) {
    if(in_array($value, $this->filterByTeches)){
        $index = array_search($value, $this->filterByTeches);
        array_splice($this->filterByTeches, $index, 1);
    } else{
        array_push($this->filterByTeches, $value);
    };
    $this->dispatch('update-filtered-projects');
};
$setSearch = function() {
    $this->dispatch('update-filtered-projects');
};

?>

<div>
    <x-hero />
    {{-- Filter --}}
    <section class="container flex flex-col items-center gap-2 px-4 mx-auto mt-16">
        <div class="flex items-center justify-between w-full">
            <h2 class="text-xl font-extrabold lg:text-3xl">Filter</h2>
            <button wire:click="clearFilter"
                class="inline-flex py-1 lg:py-2 text-cyan-500 items-center justify-center rounded-lg font-medium lg:text-lg focus:outline-none px-2 lg:px-4 focus-visible:ring shadow-sm transition-colors duration-75 border border-cyan-600 hover:bg-cyan-600 hover:text-white active:bg-cyan-700 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                Clear All
            </button>
        </div>
        <div class="w-full space-y-2">
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="w-24 text-gray-600">App Type:</div>
                <div class="flex flex-wrap flex-1 gap-x-2 gap-y-1">
                    @foreach ($this->app_types as $item)
                    <button wire:click="setAppType({{ $item->id }})"
                        class="inline-flex gap-2 py-1 text-gray-600 items-center font-thin justify-center rounded-lg focus:outline-none px-2 focus-visible:ring shadow-sm transition-colors {{ ($filterByType === $item->id) ? 'bg-cyan-100 border-gray-700' : 'bg-white border-gray-400' }} duration-75 border-2 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                        <img src="{{ asset('storage/' . $item->icon) }}" alt="icon {{ $item->name }}" class="w-5">
                        <span class="text-sm lg:text-base">
                            {{ $item->name }}
                        </span>
                    </button>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="w-24 text-gray-600">Language:</div>
                <div class="flex flex-wrap flex-1 gap-x-2 gap-y-1">
                    @foreach ($this->languages as $item)
                    <button wire:click="setLanguages({{ $item->id }})"
                        class="inline-flex gap-2 py-1 text-gray-600 items-center font-thin justify-center rounded-lg focus:outline-none px-2 focus-visible:ring shadow-sm transition-colors {{ (in_array($item->id, $this->filterByLanguages)) ? 'bg-cyan-100 border-gray-700' : 'bg-white border-gray-400' }} duration-75 border-2 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                        <img src="{{ asset('storage/' . $item->icon) }}" alt="icon {{ $item->name }}" class="w-5">
                        <span class="text-sm lg:text-base">
                            {{ $item->name }}
                        </span>
                    </button>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="w-24 text-gray-600">Teches:</div>
                <div class="flex flex-wrap flex-1 gap-x-2 gap-y-1">
                    @foreach ($this->teches as $item)
                    <button wire:click="setTeches({{ $item->id }})"
                        class="inline-flex gap-2 py-1 text-gray-600 items-center font-thin justify-center rounded-lg focus:outline-none px-2 focus-visible:ring shadow-sm transition-colors {{ (in_array($item->id, $this->filterByTeches)) ? 'bg-cyan-100 border-gray-700' : 'bg-white border-gray-400' }} duration-75 border-2 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                        <img src="{{ asset('storage/' . $item->icon) }}" alt="icon {{ $item->name }}" class="w-5">
                        <span class="text-sm lg:text-base">
                            {{ $item->name }}
                        </span>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- Projects --}}
    <section class="py-4 mt-4 bg-[#f6fdfd]">
        <div class="container flex flex-col px-4 mx-auto gap-y-2">
            <div class="flex items-center justify-between w-full gap-2">
                <div class="flex gap-2">
                    <h2 class="text-xl font-extrabold lg:text-3xl">Projects</h2>
                    <div wire:loading.remove class="font-thin lg:text-lg">
                        {{ $this->projects->count() }}
                    </div>
                    <div role="status" wire:loading>
                        <svg aria-hidden="true"
                            class="w-6 h-6 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-cyan-500"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form wire:submit="setSearch" class="relative flex-1 max-w-xs">
                    <input wire:model="filterBySearch" type="search" id="cari"
                        class="pr-11 bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400"
                        placeholder="Cari projek...">
                    <button type="submit"
                        class="absolute -translate-y-1/2 border-0 right-1 min-h-[1.75rem] md:min-h-[2rem] text-xs md:text-sm top-1/2 inline-flex text-cyan-500 items-center justify-center rounded-lg font-medium focus:outline-none px-2 focus-visible:ring transition-colors duration-75 border-cyan-600 hover:bg-cyan-600 hover:text-white active:bg-cyan-700 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div wire:loading.remove class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($this->projects as $project)
                <div class="flex flex-col justify-between p-4 bg-white border shadow-lg gap-y-2 rounded-xl">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <a href="{{ $project->demo }}"
                                class="text-lg font-bold duration-300 text-cyan-500 md:text-xl underline-offset-8 hover:underline-offset-2 hover:underline">
                                {{ $project->name }}
                            </a>
                            <a href="{{ $project->repo }}"
                                class="px-2 py-0.5 border rounded bg-gray-100 text-sm hover:bg-gray-200">Repo</a>
                        </div>
                        <div class="text-sm md:text-base">
                            {{ $project->about }}
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-x-1 gap-y-1">
                        <button wire:click="setAppType({{ $project->appType->id }})"
                            class="inline-flex gap-2 py-1 text-gray-600 items-center font-thin justify-center rounded-lg focus:outline-none px-2 focus-visible:ring shadow-sm transition-colors {{ ($project->appType->id == $filterByType) ? 'bg-cyan-100 border-gray-700' : 'bg-white border-gray-400' }} duration-75 border-2 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                            <img src="{{ asset('storage/' . $project->appType->icon) }}"
                                alt="icon {{ $project->appType->name }}" class="w-4">
                            <span class="text-sm">
                                {{ $project->appType->name }}
                            </span>
                        </button>
                        @foreach ($project->languages as $item)
                        <button wire:click="setLanguages({{ $item->id }})"
                            class="inline-flex gap-2 py-1 text-gray-600 items-center font-thin justify-center rounded-lg focus:outline-none px-2 focus-visible:ring shadow-sm transition-colors {{ (in_array($item->id, $this->filterByLanguages)) ? 'bg-cyan-100 border-gray-700' : 'bg-white border-gray-400' }} duration-75 border-2 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                            <img src="{{ asset('storage/' . $item->icon) }}" alt="icon {{ $item->name }}" class="w-4">
                            <span class="text-sm">
                                {{ $item->name }}
                            </span>
                        </button>
                        @endforeach
                        @foreach ($project->teches as $item)
                        <button wire:click="setLanguages({{ $item->id }})"
                            class="inline-flex gap-2 py-1 text-gray-600 items-center font-thin justify-center rounded-lg focus:outline-none px-2 focus-visible:ring shadow-sm transition-colors {{ (in_array($item->id, $this->filterByTeches)) ? 'bg-cyan-100 border-gray-700' : 'bg-white border-gray-400' }} duration-75 border-2 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">
                            <img src="{{ asset('storage/' . $item->icon) }}" alt="icon {{ $item->name }}" class="w-4">
                            <span class="text-sm">
                                {{ $item->name }}
                            </span>
                        </button>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div wire:loading>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @for ($i = 1; $i <= 12; $i++) <div
                        class="flex flex-col justify-between p-4 bg-white border shadow-lg rounded-xl animate-pulse aspect-[3/2]">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <div class="w-10/12 h-7 bg-slate-300"></div>
                                <div class="w-2/12 h-7 bg-slate-300"></div>
                            </div>
                            <div class="text-sm md:text-base">
                                <div class="w-full h-5 my-1 bg-slate-300"></div>
                                <div class="w-full h-5 my-1 bg-slate-300"></div>
                                <div class="w-full h-5 my-1 bg-slate-300"></div>
                                <div class="w-1/2 h-5 my-1 bg-slate-300"></div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-x-1 gap-y-1">
                            <div class="w-3/12 h-5 my-1 bg-slate-300"></div>
                            <div class="w-3/12 h-5 my-1 bg-slate-300"></div>
                            <div class="w-3/12 h-5 my-1 bg-slate-300"></div>
                        </div>
                </div>
                @endfor
            </div>
        </div>
</div>
</section>
</div>