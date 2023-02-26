@extends('layouts.backend')

@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">			    
        <div class="row justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title">{{ __('pagesBackend.master.company.modify.title') }}</h1>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-secondary" href="{{config('global.link_cms')}}/master/company">{{ __('pagesBackend.master.company.modify.btn_back') }}</a>
            </div>
        </div>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-2">
                <h3 class="section-title">{{ __('pagesBackend.master.company.modify.section_title') }}</h3>
                <div class="section-intro">{{ __('pagesBackend.master.company.modify.section_info') }}</div>
            </div>
            <div class="col-12 col-md-10">
                <div class="app-card app-card-settings shadow-sm p-4">
                    
                    <div class="app-card-body">
                        <form 
                            class="settings-form" 
                            name="cmsCompanyForm" 
                            method="POST" onsubmit="return validation()" 
                            action="{{ empty($company['id']) ? config('global.link_cms').'/master/company/process/add' : config('global.link_cms').'/master/company/process/edit'}}"
                            enctype="multipart/form-data"
                        >
                            {{ csrf_field() }}
                            @if(!empty($company['id']))
                                <input 
                                    type="hidden" 
                                    id="inCompanyId" 
                                    name="inCompanyId" 
                                    value="{{ $company['encryptId'] }}" 
                                />
                            @endif
                            <div class="mb-3">
                                <label for="in_company-name" class="form-label">{{ __('pagesBackend.master.company.modify.label_logo') }}</label>
                                <div class="text-center">
                                    @if(!empty($company['name']))
                                        <img id="preview-logo" height="200"
                                            src="/assets/images/company/{{$company['icon']}}"
                                            alt="{{empty($company['name']) ? '' : $company['name']}}" />
                                    @else
                                        <img id="preview-logo" height="200"
                                            src="/assets/images/default_no_image.png"
                                            alt="This is default logo of company (It's no logo)." />
                                    @endif
                                </div>
                                <br />
                                <input 
                                    type="file" 
                                    name="inCompanyLogo" 
                                    id="inCompanyLogo" 
                                    class="form-control text-center center-block" 
                                    accept="image/gif, image/jpeg, image/png" 
                                    onchange="preview()" 
                                /> 
                                <small class="text-danger text-left">{{ __('pagesBackend.master.company.modify.label_ico_detail') }}</small>
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyName" class="form-label">{{ __('pagesBackend.master.company.modify.label_name') }}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="inCompanyName" 
                                    name="inCompanyName" 
                                    placeholder="{{ __('pagesBackend.master.company.modify.label_name_ex') }}" 
                                    value="{{ empty($company['name']) ? '' : $company['name'] }}" 
                                    maxlength="125"  
                                />
                                <small><span class="text-danger d-none" id="errName">{{ __('pagesBackend.master.company.modify.err_name') }}</span></small>
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyURI" class="form-label">{{ __('pagesBackend.master.company.modify.label_link') }}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="inCompanyURI" 
                                    name="inCompanyURI" 
                                    placeholder="{{ __('pagesBackend.master.company.modify.label_link_ex') }}" 
                                    value="{{ empty($company['slug']) ? '' : $company['slug'] }}" 
                                    maxlength="150" 
                                />
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyPhone" class="form-label">{{ __('pagesBackend.master.company.modify.label_phone') }}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="inCompanyPhone" 
                                    name="inCompanyPhone" 
                                    placeholder="{{ __('pagesBackend.master.company.modify.label_phone_ex') }}" 
                                    value="{{ empty($company['phone']) ? '' : $company['phone'] }}" 
                                    maxlength="25"  
                                />
                                <small><span class="text-danger d-none" id="errPhone">{{ __('pagesBackend.master.company.modify.err_phone') }}</span></small>
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyMail" class="form-label">{{ __('pagesBackend.master.company.modify.label_email') }}</label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    id="inCompanyMail" 
                                    name="inCompanyMail" 
                                    placeholder="{{ __('pagesBackend.master.company.modify.label_email_ex') }}" 
                                    value="{{ empty($company['email']) ? '' : $company['email'] }}" 
                                    maxlength="125"  
                                />
                                <small><span class="text-danger d-none" id="errEmail">{{ __('pagesBackend.master.company.modify.err_email') }}</span></small>
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyTaxId" class="form-label">{{ __('pagesBackend.master.company.modify.label_tax') }}</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="inCompanyTaxId" 
                                    name="inCompanyTaxId" 
                                    placeholder="{{ __('pagesBackend.master.company.modify.label_tax_ex') }}" 
                                    value="{{ empty($company['tax_no']) ? '' : $company['tax_no'] }}" 
                                    maxlength="25" 
                                    onkeypress="return suppressNonNumericInput(event)"
                                />
                                <small><span class="text-danger d-none" id="errTaxId">{{ __('pagesBackend.master.company.modify.err_tax_id') }}</span></small>
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyAddr" class="form-label">{{ __('pagesBackend.master.company.modify.label_addr') }}</label>
                                <textarea 
                                    class="form-control" 
                                    id="inCompanyAddr" 
                                    name="inCompanyAddr">{{ empty($company['address']) ? '' : $company['address'] }}</textarea>
                                <small><span class="text-danger d-none" id="errAddr">{{ __('pagesBackend.master.company.modify.err_addr') }}</span></small>
                            </div>
                            <div class="mb-3">
                                <label for="inCompanyInfo" class="form-label">{{ __('pagesBackend.master.company.modify.label_info') }}</label>
                                <textarea 
                                    class="form-control" 
                                    id="inCompanyInfo" 
                                    name="inCompanyInfo">{{ empty($company['description']) ? '' : $company['description'] }}</textarea>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="inCompanyStatus" 
                                    name="inCompanyStatus" 
                                    @if(empty($company['flag_enabled']) || $company['flag_enabled'] == 'Y') 
                                        value="Y" checked 
                                    @else 
                                        value="N" 
                                    @endif
                                    onchange="showStatus(this)"
                                />
                                <label class="form-check-label" for="inCompanyStatus" id="label-status"> @if(empty($company['flag_enabled']) || $company['flag_enabled'] == 'Y') {{ __('pagesBackend.master.company.modify.label_active') }} @else {{ __('pagesBackend.master.company.modify.label_inactive') }} @endif </label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="inCompanyDel" 
                                    name="inCompanyDel" 
                                    @if(!empty($company['flag_deleted']) && $company['flag_deleted'] == 'Y') 
                                        value="Y" checked
                                    @else 
                                        value="N" 
                                    @endif
                                    onchange="showStatus(this)"
                                />
                                <label class="form-check-label" for="inCompanyDel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    {{ __('pagesBackend.master.company.modify.label_delete') }}
                                </label>
                            </div>
                            <button type="submit" class="btn app-btn-primary" >{{ __('pagesBackend.master.company.modify.btn_save') }}</button>
                        </form>
                    </div><!--//app-card-body-->
                    
                </div><!--//app-card-->
            </div>
        </div><!--//row-->    
        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

@stop
