 <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="addForm" type="button">
     {{ trans('Parent_trans.add_parent') }}
 </button><br><br>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover table-sm table-bordered p-0" data-page-length="50">
            <thead>
            <tr class="table-success text-center">
                <th>#</th>
                <th>{{ trans('Parent_trans.Email') }}</th>
                <th>{{ trans('Parent_trans.Name_Father') }}</th>
                <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                <th>{{ trans('Parent_trans.Job_Father') }}</th>
                <th>{{ trans('Parent_trans.Processes') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($parents as $parent)
                <tr  wire:key="{{ $parent->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $parent->email }}</td>
                    <td>{{ $parent->Father_Name }}</td>
                    <td>{{ $parent->Father_National_ID }}</td>
                    <td>{{ $parent->Father_Passport_ID }}</td>
                    <td>{{ $parent->Father_Phone }}</td>
                    <td>{{ $parent->Father_job }}</td>
                    <td>
                        <button wire:click="edit({{ $parent->id }})" title="edit"
                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                        </button>


                        <button type="button" class="btn btn-danger btn-sm" title="{{ trans('Grades_trans.Delete') }}"
                                wire:click="destroy({{ $parent->id }})"><i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <td colspan="8"><div class="badge-info"> {{trans('main.empty')}} </div></td>
            @endforelse
          </tbody>
        </table>


    </div>
 @if (App::getLocale() == 'ar')
     <div class="pull-left">
         {{ $parents->links() }}
     </div>
 @else
     <div class="pull-right">
         {{ $parents->links() }}
     </div>
 @endif

