@extends('layouts.backend')

@section('content')

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">{{ __('pagesBackend.master.company.index.title') }}</h1>
    </div>
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <div class="table-search-form row gx-1 align-items-center">
                        <div class="col-auto">
                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="{{ __('pagesBackend.master.company.index.input_search') }}">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn app-btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                {{ __('pagesBackend.master.company.index.btn_search') }}
                            </button>
                        </div>
                        <div class="col-auto">
                            <a href="{{config('global.link_cms')}}/master/company/add">
                                <button type="button" class="btn app-btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    {{ __('pagesBackend.master.company.index.btn_insert') }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
</div><!--//row-->

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">{{ __('pagesBackend.master.company.index.thead_order') }}</th>
                                <th class="cell">{{ __('pagesBackend.master.company.index.thead_icon') }}</th>
                                <th class="cell">{{ __('pagesBackend.master.company.index.thead_company') }}</th>
                                <th class="cell">{{ __('pagesBackend.master.company.index.thead_phone') }}</th>
                                <th class="cell">{{ __('pagesBackend.master.company.index.thead_email') }}</th>
                                <th class="cell">{{ __('pagesBackend.master.company.index.thead_status') }}</th>
                                <th class="cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($company as $key => $items)
                                <tr>
                                    <td class="cell">{{ sprintf('%05d', $items['id']); }}</td>
                                    <td class="cell"></td>
                                    <td class="cell"><span class="truncate">{{ $items['name'] }}</span></td>
                                    <td class="cell">{{ $items['phone'] }}</td>
                                    <td class="cell">{{ $items['email'] }}</td>
                                    <td class="cell">
                                        @if($items['flag_enabled'] == 'Y')
                                            <span class="badge bg-success">{{ __('pagesBackend.master.company.index.status_active') }}</span>
                                        @else 
                                            <span class="badge bg-danger">{{ __('pagesBackend.master.company.index.status_inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="cell">
                                        <a class="btn-sm app-btn-secondary" href="{{config('global.link_cms')}}/master/company/edit/{{$items['id']}}">
                                            {{ __('pagesBackend.master.company.index.process_modify') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
               
            </div><!--//app-card-body-->		
        </div><!--//app-card-->

        @if($pages > 1)
            @include('components.pagination', ['pages' => $pages, 'page' => $page, 'amount' => $amount])
        @endif 

    </div><!--//tab-pane-->
    
</div><!--//tab-content-->

@stop
