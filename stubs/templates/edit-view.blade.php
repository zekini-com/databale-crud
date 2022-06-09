@php
$formPath = "livewire.$resourcePlural.partials.form";
@endphp

<div class="w-4/5 m-auto">
    <form wire:submit.prevent="update" class="bg-white rounded px-8 pt-6 pb-4">
        {{'@'}}include('{{$formPath}}')

        <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
            <button type="submit" class="text-black-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                Update
            </button>
            <button wire:click="$emit('closeModal')" class="text-black-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                Close
            </button>

        </div>
    </form>


</div>
