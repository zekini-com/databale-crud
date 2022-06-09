@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}};

use App\Models\{{ucfirst($modelBaseName)}};
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public function render()
    {
        return view('livewire.{{$viewName}}.delete');
    }
}
