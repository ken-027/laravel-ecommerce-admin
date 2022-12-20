<div class="row content p-0 m-0 d-none" id="networkTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="networkForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            {{-- <label for="" class="form-label">{{ $is_edit ? ucwords($mobile->network_title) : 'Network Title' }}</label> --}}
            @if (!empty($category_only))
                <div class="form-group py-2 col-lg-6">
                    <label for="" class="form-label">Network Title</label><small class="mx-1 text-danger"></small>
                    <input type="text" name="networktitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->network_title : '' }}">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Network Tooltip</label>
                    <div class="editor-container" style="">
                        <textarea id="" class="ckeEditor network-tooltip" name="description">{{ $is_edit ? htmlspecialchars_decode($category->tooltip_network) : '' }}</textarea>
                    </div>
                </div>
            @endif
            <div id="addNetworkForm"> 
                <label for="" class="form-label">Add Network</label><small class="mx-1 text-danger"></small>
                @if(!count($category_attributes->networks))
                    <div class="cloning-container my-2">
                        <div class="form-group py-2 col-lg-6">
                            <label for="" class="form-label">Name</label><small class="mx-1 text-danger"></small>
                            <input type="text" name="networkname[]" class="form-control form-control-sm network-name" value="">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="" class="form-label">Icon</label><small class="mx-1 text-danger"></small>
                                <input type="file" name="network[icon][]" class="form-control form-control-sm network-logo" id="logoFinder" file="true" />
                            </div>
                            <div class="col-lg-3 mb-2 mt-0 d-none">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail"><img class="form-control img-network" id="output" alt=" Image display here!" src=""></div>
                                    <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group py-2 mb-2">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                @endif
                @foreach ($category_attributes->networks as $network)
                    <div class="cloning-container my-2" >
                        <div class="form-group py-2 col-lg-6">
                            <label for="" class="form-label">Name</label><small class="mx-1 text-danger"></small>
                            <input type="text" name="networkname[]" class="form-control form-control-sm network-name" value="{{ $network->network_name }}">
                            {{-- <input type="text" hidden name="networkid[]" class="form-control form-control-sm" value="{{ encrypt($network->id) }}"> --}}
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="" class="form-label">Icon</label><small class="mx-1 text-danger"></small>
                                <input type="file" name="network[icon][]" data-id="{{ encrypt($network->id) }}" class="form-control form-control-sm network-logo" id="logoFinder" file="true" value="" />
                                {{-- move_uploaded_file($_FILES['file']['tmp_name'],'/image/'.$file); --}}
                            </div>
                            @if (!empty($network->network_icon))
                                <div class="form-group col-lg-3 mb-2 mt-0 ">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                            @php $type = (!empty($category->id) && !$is_edit) ? 'categories' : 'models' @endphp
                                            <img class="form-control" id="output" data-id="" src="{{ asset('storage/'. $type . '/' . base64_encode(!empty($network->cat_id) ? $network->cat_id : $network->model_id) . '/networks/' . $network->network_icon) }}" width="200" alt="image display here"></div>
                                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group py-2 mb-2">
                            <button type="button" class="btn remove-cloned delete-db"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
        <div class="form-group py-2 mb-2">
            <button type="button" class="btn element-clone"><i class="bi bi-plus-square"></i></button>
        </div>
    </div>
</div>
