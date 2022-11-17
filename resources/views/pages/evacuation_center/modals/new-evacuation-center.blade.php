<div id="evacuationCenterModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header py-2">
                <h4 class="modal-title">Add Evacuation Center</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="{{ route('bdrrmo.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-control @error('barangay_id') is-invalid @enderror"
                                name="barangay_id"
                                id="barangay_id">
                            @foreach($barangays as $brgy)
                                <option value="{{ $brgy->id }}" {{ old('barangay_id') == $brgy->id ? 'selected' : ''  }}>{{ $brgy->name }}</option>
                            @endforeach
                        </select>
                        <label for="barangay_id">Barangay</label>
                        @error('barangay_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control @error('evacuation_center_type_id') is-invalid @enderror"
                                name="evacuation_center_type_id"
                                id="evacuation_center_type_id">
                            @foreach($evacuation_center_types as $eCenter)
                                <option value="{{ $eCenter->id }}" {{ old('evacuation_center_type_id') == $eCenter->id ? 'selected' : ''  }}>{{ $eCenter->name }}</option>
                            @endforeach
                        </select>
                        <label for="evacuation_center_type_id">Evacuation Center Type</label>
                        @error('evacuation_center_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text"
                               class="form-control numberonly @error('max_capacity') is-invalid @enderror"
                               name="max_capacity"
                               value="11"
                               min="11">
                        <label for="max_capacity">Max Capacity</label>
                        @error('max_capacity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="files">Upload Photos</label>
                        <input type="file" name="files[]" id="files" class="form-control" multiple>
                    </div>
{{--                    <div class="form-check mb-3">--}}
{{--                        <input class="form-check-input"--}}
{{--                               id="is_evacuation_center_full"--}}
{{--                               name="is_evacuation_center_full"--}}
{{--                               type="checkbox"--}}
{{--                                {{ old('is_evacuation_center_full') ? 'checked' : '' }} />--}}
{{--                        <label class="form-check-label" for="is_evacuation_center_full">Is Evacuation Center Full?</label>--}}
{{--                    </div>--}}
                </div>
                <div class="modal-footer py-1">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>