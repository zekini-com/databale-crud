@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}};

use App\Models\{{ucfirst($modelBaseName)}};
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends ModalComponent
{

    use LivewireAlert;

    public array $state;

    public function mount()
    {
        $this->state = [];
    }

    public function render()
    {
        return view('livewire.{{$viewName}}.create');
    }

    public function submit()
    {
        $this->validate();

        $this->create($this->state);

        $this->emit('refreshDatatable');

        $this->alert('success', '{{$modelBaseName}} added');

        $this->resetState();

        $this->closeModal();
    }

    private function create($data): void
    {
        @if($viewName == 'users')
            $data['password'] = 'password';
        @endif
        $model = {{$modelBaseName}}::create($data);
        @foreach($pivots as $pivot)
        $model->{{$pivot['table']}}()->sync($this->state['{{$pivot['table']}}']);
        @endforeach
    }


    protected function resetState(): void
    {
        $this->state = [];
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
