<div>

    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            {{$resource}}
        </span>
    </x-slot>



    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <button class="bg-black mb-5  text-white font-bold py-2 px-4 rounded" onclick="Livewire.emit('openModal', '{{strtolower(Str::plural($resource))}}.create')">Create {{$resource}}</button>

            @php
            $datatable = "<livewire:$componentName />";
            @endphp
            {!! $datatable !!}

        </div>
    </div>
</div>
