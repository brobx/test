@extends('admin.layouts.app')
@section('page.title', 'Frequently Asked Questions')
@section('page.description')
    <a href="{{ route('backend.admin.faqs.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
@stop
@section('page.breadcrumb')
    <li class="active">FAQs</li>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">FAQs</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->category->title }}</td>
                        <td>{{ $faq->created_at }}</td>
                        <td>
                            <a href="{{ route('backend.admin.faqs.edit', $faq->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            @include('admin.modals.delete', [
                                'id' => $faq->id,
                                'title' => $faq->question,
                                'body' => 'This Cannot be undone',
                                'route' => route('backend.admin.faqs.destroy', $faq->id)
                             ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="text-center">
                {!! $faqs->render() !!}
            </div>
        </div>
    </div>
@stop