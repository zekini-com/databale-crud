@php echo "<?php";
@endphp

namespace App\Exports;

use App\Models\{{ucfirst($modelBaseName)}};
use Maatwebsite\Excel\Concerns\FromCollection;

class {{Str::plural(ucfirst($modelBaseName))}}Export implements FromCollection
{

    public ${{strtolower(Str::plural($modelBaseName))}};

    public function __construct(${{strtolower(Str::plural($modelBaseName))}})
    {
        $this->{{strtolower(Str::plural($modelBaseName))}} = ${{strtolower(Str::plural($modelBaseName))}};
    }


    public function collection()
    {
        return {{ucfirst($modelBaseName)}}::whereIn('id', $this->{{strtolower(Str::plural($modelBaseName))}})->get();
    }


}
