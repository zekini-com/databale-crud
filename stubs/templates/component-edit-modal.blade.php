@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}};

use App\Models\{{ucfirst($modelBaseName)}};
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{

    public {{ucfirst($modelBaseName)}} ${{strtolower($modelBaseName)}};

    public array $state;

    public function mount({{ucfirst($modelBaseName)}} ${{strtolower($modelBaseName)}})
    {
        $this->{{strtolower($modelBaseName)}} = ${{strtolower($modelBaseName)}};

        $this->state = ${{strtolower($modelBaseName)}}->toArray();
    }

    public function render()
    {
        return view('livewire.{{$viewName}}.edit');
    }

    public function update()
    {
        $this->{{strtolower($modelBaseName)}}->update($this->state);

        $this->closeModal();
    }
}
