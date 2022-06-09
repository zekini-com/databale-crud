<div>
    <h1>Delete </h1>

    <form wire:submit.prevent="delete">
        <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
            <button type="submit" class="text-black-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                Delete
            </button>
            <button wire:click="$emit('closeModal')" class="text-black-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                Cancel
            </button>

        </div>
    </form>


</div>
