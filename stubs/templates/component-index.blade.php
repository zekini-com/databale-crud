@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}};

use {{ $modelFullName }};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;


@php($lowerModelBaseName = Str::camel($modelBaseName))

class {{Str::plural($modelBaseName)}} extends Component
{
    @if(! $isReadonly)
    use WithFileUploads;
    use AuthorizesRequests;

    public {{$modelBaseName}} ${{$lowerModelBaseName}};

    public $state;

    public ${{$lowerModelBaseName}}CreateModal = false;

    public ${{$lowerModelBaseName}}EditModal = false;

    protected $listeners = [
        'launch{{$modelBaseName}}CreateModal',
        'launch{{$modelBaseName}}EditModal',
        'flashMessageEvent' => 'flashMessageEvent'
    ];

    public function mount()
    {
       $this->state = [];
    }
    @endif

    public function render()
    {
        return view('livewire.{{$viewName}}.index')
            ->extends('zekini/livewire-crud-generator::admin.layout.default')
            ->section('body');
    }

    @if(! $isReadonly)
    public function submit()
    {
        $this->validate();

        $this->create($this->state);

        $this->flashMessageEvent('Item successfully created');

        $this->resetState();

        $this->closeModalButton();
    }

    public function editSubmit()
    {

        $this->validate();

        $this->update($this->state, $this->state['id']);

        $this->resetState();

        $this->closeModalButton();
    }

    public function closeModalButton()
    {
        $this->{{$lowerModelBaseName}}CreateModal = false;
        $this->{{$lowerModelBaseName}}EditModal = false;
    }

    public function launch{{$modelBaseName}}CreateModal()
    {
        $this->{{$lowerModelBaseName}}CreateModal = true;
    }

    public function launch{{$modelBaseName}}EditModal({{$modelBaseName}} ${{$lowerModelBaseName}})
    {
        $this->state = ${{$lowerModelBaseName}}->toArray();
        @foreach($pivots as $pivot)
        $this->state['{{$pivot["table"]}}'] = ${{$lowerModelBaseName}}->{{$pivot["table"]}}()->allRelatedIds()->toArray();
        @endforeach
        $this->{{$lowerModelBaseName}}EditModal = true;
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

    protected function resetState(): void
    {
        $this->state = [];
    }

    private function create($data): void
    {

        $model = {{$modelBaseName}}::create($data);
        @foreach($pivots as $pivot)
        @if($modelBaseName == 'ZekiniAdmin')
        $model->{{$pivot['table']}}()->syncWithPivotValues($this->state['{{$pivot['table']}}'], [
            'model_type' => 'Zekini\CrudGenerator\Models\ZekiniAdmin'
        ]);
        @else
        $model->{{$pivot['table']}}()->sync($this->state['{{$pivot['table']}}']);
        @endif
        @endforeach
    }

    private function update($data, $id): void
    {
        $model = {{$modelBaseName}}::findOrFail($id);

        $model->update($data);
        @foreach($pivots as $pivot)
        @if($modelBaseName == 'ZekiniAdmin')
        $model->{{$pivot['table']}}()->syncWithPivotValues($this->state['{{$pivot['table']}}'], [
            'model_type' => 'Zekini\CrudGenerator\Models\ZekiniAdmin'
        ]);
        @else
        $model->{{$pivot['table']}}()->sync($this->state['{{$pivot['table']}}']);
        @endif

        @endforeach
    }
    @endif
}
