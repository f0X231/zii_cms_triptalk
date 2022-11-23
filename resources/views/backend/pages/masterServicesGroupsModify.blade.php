@extends('layouts.backend')

@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">			    
        <div class="row justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title">{{ __('pagesBackend.master.sgroups.modify.title') }}</h1>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-secondary" href="{{config('global.link_cms')}}/master/services-groups">{{ __('pagesBackend.master.sgroups.modify.btn_back') }}</a>
            </div>
        </div>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-2">
                <h3 class="section-title">{{ __('pagesBackend.master.sgroups.modify.section_title') }}</h3>
                <div class="section-intro">{{ __('pagesBackend.master.sgroups.modify.section_info') }}</div>
            </div>
            <div class="col-12 col-md-10">
                <div class="app-card app-card-settings shadow-sm p-4">
                    
                    <div class="app-card-body">
                        <form 
                            class="settings-form" 
                            name="cmsSGroupsForm" 
                            method="POST" onsubmit="return validation()" 
                            action="{{ empty($sgroup['id']) ? config('global.link_cms').'/master/services-groups/process/add' : config('global.link_cms').'/master/services-groups/process/edit'}}"
                            enctype="multipart/form-data"
                        >
                            {{ csrf_field() }}
                            @if(!empty($sgroup['id']))
                                <input 
                                    type="hidden" 
                                    id="inSGroupsId" 
                                    name="inSGroupsId" 
                                    value="{{ $sgroup['encryptId'] }}" 
                                />
                            @endif
                            <div class="mb-3">
                                <label for="in_sgroups-name" class="form-label">{{ __('pagesBackend.master.sgroups.modify.label_logo') }}</label>
                                <div class="text-center">
                                    @if(!empty($sgroup['logo']))
                                        <img id="preview-logo" height="200"
                                            src="/assets/images/services/{{$sgroup['logo']}}"
                                            alt="{{empty($sgroup['name_en']) ? '' : $sgroup['name_en']}}" />
                                    @else
                                        <img id="preview-logo" height="200"
                                            src="/assets/images/default_no_image.png"
                                            alt="This is default badge of groups of services (It's no badge)." />
                                    @endif
                                </div>
                                <br />
                                <input 
                                    type="file" 
                                    name="inSGroupsLogo" 
                                    id="inSGroupsLogo" 
                                    class="form-control text-center center-block" 
                                    accept="image/gif, image/jpeg, image/png" 
                                    onchange="preview()" 
                                /> 
                                <small class="text-danger text-left">{{ __('pagesBackend.master.sgroups.modify.label_ico_detail') }}</small>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-6">
                                    <label for="inSgroupsNameEN" class="form-label">{{ __('pagesBackend.master.sgroups.modify.label_name_en') }}</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="inSgroupsNameEN" 
                                        name="inSgroupsNameEN" 
                                        placeholder="{{ __('pagesBackend.master.sgroups.modify.label_name_ex') }}" 
                                        value="{{ empty($sgroup['name_en']) ? '' : $sgroup['name_en'] }}" 
                                        maxlength="125"  
                                    />
                                    <small><span class="text-danger d-none" id="errNameEN">{{ __('pagesBackend.master.sgroups.modify.err_name') }}</span></small>
                                </div>
                                <div class="col-6">
                                    <label for="inSgroupsNameTH" class="form-label">{{ __('pagesBackend.master.sgroups.modify.label_name_th') }}</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="inSgroupsNameTH" 
                                        name="inSgroupsNameTH" 
                                        placeholder="{{ __('pagesBackend.master.sgroups.modify.label_name_ex') }}" 
                                        value="{{ empty($sgroup['name_th']) ? '' : $sgroup['name_th'] }}" 
                                        maxlength="125"  
                                    />
                                    <small><span class="text-danger d-none" id="errNameTH">{{ __('pagesBackend.master.sgroups.modify.err_name') }}</span></small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inSGroupsInfo" class="form-label">{{ __('pagesBackend.master.sgroups.modify.label_info') }}</label>
                                <textarea 
                                    class="form-control" 
                                    id="inSGroupsInfo" 
                                    name="inSGroupsInfo">{{ empty($sgroup['description']) ? '' : $sgroup['description'] }}</textarea>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="inSGroupsStatus" 
                                    name="inSGroupsStatus" 
                                    @if(empty($sgroup['flag_enabled']) || $sgroup['flag_enabled'] == 'Y') 
                                        value="Y" checked 
                                    @else 
                                        value="N" 
                                    @endif
                                    onchange="showStatus(this)"
                                />
                                <label class="form-check-label" for="inSGroupsStatus" id="label-status"> @if(empty($sgroup['flag_enabled']) || $sgroup['flag_enabled'] == 'Y') {{ __('pagesBackend.master.sgroups.modify.label_active') }} @else {{ __('pagesBackend.master.sgroups.modify.label_inactive') }} @endif </label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="inSGroupsDel" 
                                    name="inSGroupsDel" 
                                    @if(!empty($sgroup['flag_deleted']) && $sgroup['flag_deleted'] == 'Y') 
                                        value="Y" checked
                                    @else 
                                        value="N" 
                                    @endif
                                    onchange="showStatus(this)"
                                />
                                <label class="form-check-label" for="inSGroupsDel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    {{ __('pagesBackend.master.sgroups.modify.label_delete') }}
                                </label>
                            </div>
                            <button type="submit" class="btn app-btn-primary" >{{ __('pagesBackend.master.sgroups.modify.btn_save') }}</button>
                        </form>
                    </div><!--//app-card-body-->
                    
                </div><!--//app-card-->
            </div>
        </div><!--//row-->    
        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

@stop
