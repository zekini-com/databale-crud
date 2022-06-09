@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}};

use App\Models\{{ucfirst($modelBaseName)}};
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends ModalComponent
{
    use LivewireAlert;

    public {{ucfirst($modelBaseName)}} ${{strtolower($modelBaseName)}};

    public array $state;

    public function mount(int $id)
    {
        $this->{{strtolower($modelBaseName)}} = {{ucfirst($modelBaseName)}}::find($id);

        $this->state = $this->{{strtolower($modelBaseName)}}->toArray();
    }

    public function render()
    {
        return view('livewire.{{$viewName}}.edit');
    }

    public function update()
    {
        $this->validate();

        $this->{{strtolower($modelBaseName)}}->update($this->state);

        $this->emit('refreshDatatable');

        $this->alert('success', '{{strtolower($modelBaseName)}} updated');

        $this->closeModal();
    }

    protected function rules()
    {
        return [
            @foreach($vissibleColumns as $col)
            @if($userModel && in_array($col['name'], ['name']))
            'state.{{$col['name']}}' => 'required|min:3|max:255|unique:{{$tableName}},{{$col["name"]}},' . @$this->state['id'],
            @elseif($userModel && $col['name'] === 'email')
            'state.{{$col['name']}}' => 'required|email:rfc|min:3|max:255|unique:{{$tableName}},{{$col["name"]}},' . @$this->state['id'],
            @else
            'state.{{$col['name']}}' => 'required',
            @endif
            @endforeach
        ];
    }
}
