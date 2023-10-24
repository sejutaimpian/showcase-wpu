<?php

use function Livewire\Volt\{state};

//

?>

<nav class="flex justify-between px-4 py-2 shadow lg:px-8 lg:py-3">
    <div class="flex items-center gap-2">
        <img class="w-8" src="{{ asset('storage/logo.png') }}" alt="Logo Showcase WPU">
        <span class="text-base font-bold lg:text-lg">Showcase WPU</span>
    </div>
    <div class="flex items-center gap-2">
        <a href="https://github.com/sejutaimpian/showcase-wpu">
            <img class="w-8" src="{{ asset('storage/github.svg') }}" alt="Logo Github">
        </a>
        <a href="{{ route('login') }}" wire:navigate
            class="inline-flex text-cyan-500 items-center justify-center rounded-lg font-medium lg:text-lg focus:outline-none px-2 lg:px-3 focus-visible:ring shadow-sm transition-colors duration-75 border border-cyan-600 hover:bg-cyan-600 hover:text-white active:bg-cyan-700 disabled:bg-cyan-700 focus-visible:ring-cyan-400 disabled:cursor-not-allowed;">Login</a>
    </div>
</nav>