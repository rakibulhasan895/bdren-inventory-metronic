<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Product</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" method="post" class="form" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">


                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-lg-end pt-2">Brand</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="brand-dropdown" name="brand_id">
                                    <option value="">---</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->code }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-lg-end pt-2">Model</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="model-dropdown" name="model_id">
                                    <option value="">---</option>
                                    @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->code }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-lg-end pt-2">Category</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="category-dropdown" name="category_id">
                                    <option value="">---</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->code }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2">Product Name <span class="required"></span></label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Enter Product Name ..." required value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2">Product Description <span class="required"></span></label>
                            <div class="col-sm-8">
                                <input type="text" name="description" class="form-control" placeholder="Enter Product Details ..." required value="{{ old('description') }}" />

                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2">Asset Code<span class="required"></span></label>
                            <div class="col-sm-8">
                                <input type="text" name="asset_code" class="form-control" placeholder="Enter Asset Code" required value="{{ old('asset_code') }}" />
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2"><span class=""></span></label>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input type="checkbox" name="consumable" class="form-check-input" id="consumableCheckbox" value="1" value="{{ old('consumable') }}" />
                                    <label class="form-check-label" for="consumableCheckbox">Is Consumable</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 control-label text-sm-end pt-2" for="formFile">Product Image <span class="required"></span></label>
                            <div class="col-sm-8">
                                <input type="file" name="image" accept="image/*" class="form-control" onchange="loadFile(event)" id="formFile" required value="{{ old('image') }}">
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-sm-8 text-center">
                                <div>
                                    <img id="output" height="100px" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->


            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading wire:target="submit">
                        Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
            <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->
</div>
