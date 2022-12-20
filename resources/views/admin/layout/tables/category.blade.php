
@if (empty($categories))
    <tr class="odd" data-child-value="hidden 1">
        <td valign="top" colspan="6" class="dataTables_empty">No matching records found</td>
    </tr>
@else
    @foreach ($categories as $category)
    <tr class="data-row" data-child-value="hidden 1">
        <td class="multi-check"><input class="form-check-input check-row" type="checkbox" value="" id=""></td>
        <td><img class="img-thumbnail icon" src="{{ asset('/assets/images/categories/'. $category->image) }}" alt=""></td>
        <td>{{ $category->title }}</td>
        <td>{{ $category->fields_type }}</td>
        <td><input type="text" class="form-control form-control-sm w-50"></td>
        <td>
            <button class="btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil"></i></button>
            <button class="btn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>
            <button class="btn" data-toggle="tooltip" data-placement="top" title="Publish"><i class="bi bi-file-earmark-arrow-up"></i></button>
        </td>
    </tr>
    @endforeach
@endif
{{-- <tr class="data-row">
    <td class="multi-check"><input class="form-check-input check-row" type="checkbox" value="" id=""></td>
    <td><img class="img-thumbnail icon" src="{{ asset('/assets/images/mobile/20211203160027.png') }}" alt=""></td>
    <td>Phones</td>
    <td>Mobile</td>
    <td><input type="text" class="form-control form-control-sm w-50"></td>
    <td>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil"></i></button>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Publish"><i class="bi bi-file-earmark-arrow-up"></i></button>
    </td>
</tr> --}}
{{-- 
<tr class="data-row">
    <td class="multi-check"><input class="form-check-input check-row" type="checkbox" value="" id=""></td>
    <td><img class="img-thumbnail" src="{{ asset('/assets/images/mobile/20190902230040.png') }}" width="100px" alt=""></td>
    <td>Watch</td>
    <td>Watch</td>
    <td><input type="text" class="form-control form-control-sm w-50"></td>
    <td>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil"></i></button>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Publish"><i class="bi bi-file-earmark-arrow-up"></i></button>
    </td>
</tr>
<tr class="data-row">
    <td class="multi-check"><input class="form-check-input check-row" type="checkbox" value="" id="flexCheckDefault"></td>
    <td><img class="img-thumbnail" src="{{ asset('/assets/images/mobile/20190902162836.png') }}" width="100px" alt=""></td>
    <td>Airpod</td>
    <td>Airpod</td>
    <td><input type="text" class="form-control form-control-sm w-50"></td>
    <td>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil"></i></button>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>
        <button class="btn" data-toggle="tooltip" data-placement="top" title="Publish"><i class="bi bi-file-earmark-arrow-up"></i></button>
    </td>
</tr> --}}
