@php echo "<?php";
@endphp

namespace App\Http\Livewire\{{Str::plural(ucfirst($modelBaseName))}}\Datatable;

use App\Imports\{{Str::plural(ucfirst($modelBaseName))}}Import;
use App\Exports\{{Str::plural(ucfirst($modelBaseName))}}Export;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use {{ $modelFullName }};
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use Zekini\DatatableCrud\Traits\WithEditing;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

@php $isActivityLogModel = ucfirst($modelBaseName) == 'ActivityLog'; @endphp

class {{Str::plural(ucfirst($modelBaseName))}}Table extends DataTableComponent
{
    use AuthorizesRequests;
    use WithFileUploads;
    use WithEditing;

    public $model = {{ucfirst($modelBaseName)}}::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchEnabled();
        $this->setSearchDebounce(1500);
        $this->setQueryStringDisabled();
        $this->setAdditionalSelects(['{{strtolower(Str::plural($modelBaseName))}}.id as id']);
    }

    public function activate($id)
    {
        $model = {{ucfirst($modelBaseName)}}::where('id', $id)->first();
        $model->active = true;
        $model->save();
        $this->emit('showAlert', '{{ucfirst($modelBaseName)}} updated');
    }

    public function deactivate($id)
    {
        $model = {{ucfirst($modelBaseName)}}::where('id', $id)->first();
        $model->active = true;
        $model->save();
        $this->emit('showAlert', '{{ucfirst($modelBaseName)}} updated');
    }

    public function exportSelected()
    {
        foreach ($this->getSelected() as $item) {
            debug($item); // These are strings since they came from an HTML element
        }
    }




    public function columns():array
    {
        return [

            @foreach($vissibleColumns as $col)

                @switch($col['type'])
                    @case('integer')
                    @case('date')
                    @case('datetime')
                    @case('string')
                    Column::make('{{ucfirst($col['name'])}}', '{{$col['name']}}')
                    ->searchable()
                    ->sortable(),
                    @break
                    @case('boolean')
                    BooleanColumn::make('{{$col['name']}}')
                    ->label('{{ucfirst($col['name'])}}')
                    ->sortable(),
                    @break

                    @default

                    Column::make('{{$col['name']}}')
                        ->label('{{ucfirst($col['name'])}}')
                        ->searchable(),

                    @break
                @endswitch
            @endforeach



            //Has one and belongs To Relationships
            @foreach($vissibleRelationships as $npRelation)
                Column::make('{{ucfirst(Str::getRelationship($npRelation))}}', '{{Str::getRelationship($npRelation)}}.{{$tableTitleMap[$npRelation['table']]}}')

            ,
            @endforeach

            @if(! $isReadonly)
            Column::make('Actions')->label(function($row){
                $id = $row->id;
                return view('zekini/datatable-crud::table-actions', [
                    'id' => $id,
                    'editRoute'=>"/{{strtolower(Str::plural($modelBaseName))}}/$id/edit"
                ]);
            })

            @endif
        ];
    }



    public function filters(): array
    {
        return [
            SelectFilter::make('Active')
                ->options([
                    '' => 'All',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }

    public function export()
    {
        $items = $this->getSelected();

        return Excel::download(new {{ucfirst(Str::plural($modelBaseName))}}Export($items), '{{strtolower(Str::plural($modelBaseName))}}.xlsx');
    }
}
