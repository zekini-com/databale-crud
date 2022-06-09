<div>


    <form wire:submit.prevent="delete">
        <h1 class="text-center text-2xl py-5">Are you sure you want to proceed? </h1>
        <div class="flex items-center justify-center p-6 border-t border-solid border-gray-200 rounded-b">

            <button wire:click="$emit('closeModal')" class="text-black-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                Cancel
            </button>
            <button type="submit" class="text-white bg-red-400  rounded-sm background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                Delete
            </button>

        </div>
    </form>


</div>
