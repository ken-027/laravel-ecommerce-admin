<div class="row content p-0 m-0 d-none" id="tooltipTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="tooltipForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2">
                <label for="" class="form-label">Tootlip of Condition</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor"
                        name="tooltipcondition">{{ $is_edit ? $device->tooltip_condition : '' }}</textarea>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Tooltip of Network</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor"
                        name="tooltipnetwork">{{ $is_edit ? $device->tooltip_network : '' }}</textarea>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Sub Title</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor" name="subtitle">{{ $is_edit ? $device->sub_title : '' }}</textarea>
                </div>
            </div>
        </form>
    </div>
</div>
