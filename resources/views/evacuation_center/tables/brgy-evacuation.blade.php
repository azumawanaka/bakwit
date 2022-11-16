
<table class="table table-dashed">
    <div class="mb-3">
        Legend:
        <small><span class="legend bg-danger"></span> Full</small> 
        <small><span class="legend bg-success"></span> Available</small>
    </div>
    <thead>
        <tr>
            <th>Barangay</th>
            <th>Evacuation Center Type</th>
            <th>Maximum Capacity</th>
            <th>Families</th>
            <th>Males</th>
            <th>Females</th>
            <th>PWDs</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($evacuationCenters as $center)
        <tr>
            <td>{{ $center->barangay->name }}</td>
            <td>{{ $center->evacuationCenterType->name }}</td>
            <td>{{ $center->max_capacity }}</td>
            <td>{!! !isset($center->evacuees->family_count) ? '<span class="text-danger">0</span>' : $center->evacuees->family_count !!}</td>
            <td>{!! !isset($center->evacuees->family_count) ? '<span class="text-danger">0</span>' : $center->evacuees->male_count !!}</td>
            <td>{!! !isset($center->evacuees->family_count) ? '<span class="text-danger">0</span>' : $center->evacuees->female_count !!}</td>
            <td>{!! !isset($center->evacuees->family_count) ? '<span class="text-danger">0</span>' : $center->evacuees->pwd_count !!}</td>
            <td>
                <span class="legend bg-{{ $center->is_evacuation_center_full ? 'danger' : 'success' }}"></span></td>
            <td>
                <a href="#" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="#" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-pencil"></i>
                </a>
                <a href="#" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>