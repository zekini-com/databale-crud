@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}};

use App\Models\{{ucfirst($modelBaseName)}};
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends ModalComponent
{
    use LivewireAlert;

    public int $modelId;

    public function mount(int $modelId)
    {
        $this->modelId = $modelId;
    }

    public function render()
    {
        return view('livewire.{{$viewName}}.delete');
    }

    public function delete()
    {

        {{ucfirst($modelBaseName)}}::find($this->modelId)->delete();

        $this->emit('refreshDatatable');

        $this->alert('success', '{{strtolower($modelBaseName)}} deleted');

        $this->closeModal();
    }
}
