<?php

use App\Models\{AppType, Developer, Language, Project, Tech, Time};
use function Livewire\Volt\{computed, layout, rules, state, title};

layout('layouts.app');
title('Form Tambah Showcase');

$appTypes = computed(function(){
    return AppType::all();
})->persist();

$developers = computed(function(){
    return Developer::all();
})->persist();
$languages = computed(function(){
    return Language::all();
})->persist();
$teches = computed(function(){
    return Tech::all();
})->persist();

state([
    'timeName'=> '',
    'timeTime'=> '',
    'timeDesc'=> '',
    'projects'=> [
        [
            'name'=> '',
            'about'=> '',
            'description'=> '',
            'demo'=> '',
            'repo'=> '',
            'app_type_id'=> '',
            'developer_id'=> '',
        ]
    ],
    'lang' => [[]],
    'tech' => [[]],
]);

rules([
    'timeName'=> 'required|min:3',
    'timeTime'=> 'required|date',
    'timeDesc'=> 'required|min:3',
    'projects.*.name'=> 'required|min:3',
    'projects.*.about'=> 'required|min:3',
    'projects.*.description'=> 'required',
    'projects.*.demo'=> 'nullable|url:http,https',
    'projects.*.repo'=> 'nullable|url:http,https',
    'projects.*.app_type_id'=> 'required|numeric',
    'projects.*.developer_id'=> 'required|numeric',
    'lang.*'=> 'required|numeric',
    'tech.*'=> 'required|numeric',
])->attributes([
    'timeName' => 'judul waktu',
    'timeTime' => 'waktu',
    'timeDesc' => 'deskripsi waktu',
    'projects.*.name'=> 'nama projek',
    'projects.*.about'=> 'tentang app',
    'projects.*.description'=> 'deskripsi app',
    'projects.*.demo'=> 'link demo app',
    'projects.*.repo'=> 'link repo app',
    'projects.*.app_type_id'=> 'tipe app',
    'projects.*.developer_id'=> 'developer',
    'lang.*'=> 'bahasa',
    'tech.*'=> 'teknologi',
]);

$clearState = function(){
    $this->timeName = '';
    $this->timeTime = '';
    $this->timeDesc = '';
    $this->projects = [
        [
            'name'=> '',
            'about'=> '',
            'description'=> '',
            'demo'=> '',
            'repo'=> '',
            'app_type_id'=> '',
            'developer_id'=> ''
        ]
    ];
    $this->lang = [[]];
    $this->tech = [[]];

    $this->js("Swal.fire(
            'Sukses Mereset Form',
            '',
            'success'
        )"
    );
};

$save = function(){
    // $this->validate();

    $createdTime = Time::create([
        'name' => $this->timeName,
        'time' => $this->timeTime,
        'description' => $this->timeDesc
    ]);

    foreach ($this->projects as $key => $item) {
        $projectCreated = Project::create(['time_id' => $createdTime->id, ...$item]);
        $projectCreated->languages()->attach($this->lang[$key]);
        $projectCreated->teches()->attach($this->tech[$key]);
    }
    
    $this->clearState();
    $this->js("Swal.fire(
            'Sukses Menambah Projek',
            '',
            'success'
        )"
    );
};
$addProject = function(){
    $this->projects[] = [
        'name'=> '',
        'about'=> '',
        'description'=> '',
        'demo'=> '',
        'repo'=> ''
    ];
    $this->lang[] = [];
    $this->tech[] = [];
};
$dumpProjects = function(){
    dump($this->tech);
};
?>

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endpush

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Form Tambah Showcase') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form wire:submit="save" class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            {{-- Time Section --}}
            <div class="p-4 space-y-2 bg-white shadow md:space-y-4 sm:p-8">
                <div>
                    <label for="timeTime">Waktu</label>
                    <div class="relative">
                        <input name="timeTime" type="date" id="timeTime" wire:model='timeTime'
                            class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400">
                    </div>
                    @error('timeTime')
                        <p class="text-red-500 text-xs font-normal mt-0.5 lg:text-sm lg:mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="timeName">Judul</label>
                    <div class="relative">
                        <input name="timeName" type="text" id="timeName" placeholder="Judul waktu biar readable..." wire:model='timeName'
                            class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400">
                    </div>
                    @error('timeName')
                    <p class="text-red-500 text-xs font-normal mt-0.5 lg:text-sm lg:mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="timeDesc">Deskripsi</label>
                    <div class="relative">
                        <textarea name="timeDesc" type="text" id="timeDesc" placeholder="Deskripsi waktu..." wire:model='timeDesc'
                            class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400"></textarea>
                    </div>
                    @error('timeDesc')
                    <p class="text-red-500 text-xs font-normal mt-0.5 lg:text-sm lg:mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Project Section --}}       
            <div class="p-4 space-y-8 bg-white shadow sm:p-8">
                @foreach ($projects as $project)
                <div class="flex flex-col sm:flex-row gap-x-4 gap-y-2 sm:rounded-lg">
                    <div>
                        <div class="flex items-center justify-center w-8 rounded-full bg-cyan-100 aspect-square">{{ $loop->iteration }}</div>
                    </div>
                    <div class="flex flex-wrap flex-1 gap-y-2">
                        {{-- Nama Projek --}}
                        <div class="w-full md:w-1/2">
                            <label for="projectName">Nama Projek</label>
                            <div class="relative md:w-11/12">
                                <input name="projectName" type="text" id="projectName" placeholder="Nama project"
                                    wire:model='projects.{{ $loop->index }}.name'
                                    class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400">
                            </div>
                            {{-- Entah kenapa validasi error array nested ini tidak bekerja --}}
                            @error("projects.{{ $loop->index }}.name")
                            <p class="text-red-500 text-xs font-normal mt-0.5 lg:text-sm lg:mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- About --}}
                        <div class="w-full md:w-1/2">
                            <label for="projectAbout">Tentang Aplikasi</label>
                            <div class="relative md:w-11/12">
                                <input name="projectAbout" type="text" id="projectAbout" placeholder="Tentang app"
                                    wire:model='projects.{{ $loop->index }}.about'
                                    class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400">
                            </div>
                        </div>
                        {{-- Deskripsi --}}
                        <div class="w-full">
                            <label for="projectDesc">Deskripsi Aplikasi</label>
                            <div class="relative">
                                <textarea name="projectDesc" id="projectDesc" placeholder="Deskripsi app"
                                    wire:model='projects.{{ $loop->index }}.description'
                                    class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400"></textarea>
                            </div>
                        </div>
                        {{-- Demo --}}
                        <div class="w-full md:w-1/2">
                            <label for="projectDemo">Link Demo</label>
                            <div class="relative md:w-11/12">
                                <input name="projectDemo" type="text" id="projectDemo" placeholder="Link demo app"
                                    wire:model='projects.{{ $loop->index }}.demo'
                                    class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400">
                            </div>
                        </div>
                        {{-- Repo --}}
                        <div class="w-full md:w-1/2">
                            <label for="projectRepo">Link Repo</label>
                            <div class="relative md:w-11/12">
                                <input name="projectRepo" type="text" id="projectRepo" placeholder="Link repo app"
                                    wire:model='projects.{{ $loop->index }}.repo'
                                    class="bg-white flex w-full px-3 rounded-lg shadow-sm shadow-cyan-200 min-h-[2.25rem] py-0 md:min-h-[2.5rem] border border-gray-300 outline-0 focus:border-cyan-500 focus:ring-cyan-500 placeholder:text-gray-400">
                            </div>
                        </div>
                        {{-- Tipe App --}}
                        <div class="w-full md:w-1/2">
                            <label for="appType">Tipe Aplikasi</label>
                            <div class="relative md:w-11/12">
                                <select name="appType" id="appType" wire:model='projects.{{ $loop->index }}.app_type_id'>
                                    <option value="">Pilih Tipe</option>
                                    @foreach ($this->appTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Developer --}}
                        <div class="w-full md:w-1/2">
                            <label for="developer">Developer</label>
                            <div class="relative md:w-11/12">
                                <select name="developer" id="developer" wire:model='projects.{{ $loop->index }}.developer_id'>
                                    <option value="">Pilih Devloper</option>
                                    @foreach ($this->developers as $dev)
                                    <option value="{{ $dev->id }}">{{ $dev->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Bahasa --}}
                        <div class="w-full">
                            <h4>Bahasa</h4>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                                @foreach ($this->languages as $item)
                                <div class="flex items-center gap-x-1">
                                    <input type="checkbox" id="lang_{{ $loop->parent->index }}_{{ $loop->index }}" value="{{ $item->id }}" wire:model="lang.{{ $loop->parent->index }}"
                                    class="w-4 h-4 rounded cursor-pointer checked:bg-cyan-400 checked:focus:bg-cyan-400 focus:ring-1 focus:ring-cyan-500 hover:bg-cyan-500 checked:hover:bg-cyan-400 min-h-min" >
                                    <label class="cursor-pointer" for="lang_{{ $loop->parent->index }}_{{ $loop->index }}">{{ $item->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Teknologi --}}
                        <div class="w-full">
                            <h4>Teknologi</h4>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                                @foreach ($this->teches as $item)
                                <div class="flex items-center gap-x-1">
                                    <input type="checkbox" id="tech_{{ $loop->parent->index }}_{{ $loop->index }}" value="{{ $item->id }}"
                                        wire:model="tech.{{ $loop->parent->index }}"
                                        class="w-4 h-4 rounded cursor-pointer checked:bg-cyan-400 checked:focus:bg-cyan-400 focus:ring-1 focus:ring-cyan-500 hover:bg-cyan-500 checked:hover:bg-cyan-400 min-h-min">
                                    <label class="cursor-pointer" for="tech_{{ $loop->parent->index }}_{{ $loop->index }}">{{ $item->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg flex justify-between">
                <div>
                    <button type="button" x-on:click="
                        Swal.fire({
                            title: 'Yakin mau reset form?',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Reset',
                            denyButtonText: `Jangan Reset`,
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $wire.clearState()
                            } else if (result.isDenied) {
                                Swal.fire('Form tidak jadi direset', '', 'info')
                            }
                        })
                    "
                        class="inline-flex items-center justify-center w-32 gap-2 px-2 py-1 font-thin text-black transition-colors duration-75 bg-white border rounded-lg shadow-sm focus:outline-none focus-visible:ring border-cyan-400 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed">
                        Reset Form
                    </button>
                </div>
                <div class="flex justify-end gap-x-4">
                    <button type="button" wire:click='addProject'
                        class="inline-flex items-center justify-center w-32 gap-2 px-2 py-1 font-thin text-black transition-colors duration-75 bg-white border rounded-lg shadow-sm focus:outline-none focus-visible:ring border-cyan-400 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed">
                        Add Project
                    </button>
                    <button type="submit" wire:click='save'
                        class="inline-flex items-center justify-center w-32 gap-2 px-2 py-1 font-thin text-black transition-colors duration-75 border rounded-lg shadow-sm focus:outline-none focus-visible:ring bg-cyan-300 border-cyan-400 hover:shadow-lg active:bg-cyan-200 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
