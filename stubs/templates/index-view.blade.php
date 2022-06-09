<div>

    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            {{$resource}}
        </span>
    </x-slot>



    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <button onclick="Livewire.emit('openModal', '{{strtolower(Str::plural($resource))}}.edit')">Create {{$resource}}</button>

            @php
            $datatable = "<livewire:$componentName />";
            @endphp
            {!! $datatable !!}

        </div>
    </div>
</div>
