<x-click-modal action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="start_date" class="form-control" value="{{ $data->start_date ?? request()->start_date }}">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="end_date" class="form-control" value="{{ $data->end_date ?? request()->end_date }}">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <textarea name="title" class="form-control">{{ $data->title }}</textarea>
            </div>
        </div> 
    </div>
    
</x-click-modal>